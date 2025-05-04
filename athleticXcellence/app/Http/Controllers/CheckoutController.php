<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\WebhookSignature;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout.show', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:stripe,paypal,bank_transfer'
        ]);

        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }
    
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // For non-Stripe payments
        if ($request->payment_method !== 'stripe') {
            $order = $this->createOrder($user, $cartItems, $total, $request->payment_method);
            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');
        }

        // For Stripe payments
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            
            $lineItems = $cartItems->map(function ($item) {
                return [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item->product->name,
                            'metadata' => [
                                'product_id' => $item->product_id
                            ]
                        ],
                        'unit_amount' => round($item->product->price * 100),
                    ],
                    'quantity' => $item->quantity,
                ];
            })->toArray();

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                'customer_email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                    'cart_total' => $total
                ],
            ]);

            session(['stripe_checkout' => [
                'cart_items' => $cartItems,
                'total_amount' => $total,
                'payment_method' => 'stripe'
            ]]);

            return redirect($session->url);

        } catch (ApiErrorException $e) {
            return redirect()->back()
                ->with('error', 'Error processing payment: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        if (!$request->has('session_id')) {
            return redirect()->route('checkout.cancel');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($request->session_id);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout.cancel');
            }

            $checkoutData = session('stripe_checkout');
            if (!$checkoutData) {
                return redirect()->route('cart.show')
                    ->with('error', 'Session expired. Please try again.');
            }

            $user = auth()->user();
            
            $order = $this->createOrder(
                $user,
                $checkoutData['cart_items'],
                $checkoutData['total_amount'],
                'stripe'
            );

            $order->update([
                'status' => 'completed',
                'transaction_id' => $session->payment_intent
            ]);

            session()->forget('stripe_checkout');

            return view('checkout.success', compact('order'));

        } catch (ApiErrorException $e) {
            return redirect()->route('checkout.cancel')
                ->with('error', 'Error verifying payment: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        $checkoutData = session('stripe_checkout');
        
        if ($checkoutData) {
            $user = auth()->user();
            
            $order = $this->createOrder(
                $user,
                $checkoutData['cart_items'],
                $checkoutData['total_amount'],
                'stripe'
            );
            
            $order->update(['status' => 'canceled']);
            
            session()->forget('stripe_checkout');
            
            return view('checkout.cancel', compact('order'));
        }
        
        return view('checkout.cancel', ['order' => null]);
    }

    public function handleWebhook(Request $request)
    {
        try {
            $payload = $request->getContent();
            $sigHeader = $request->header('Stripe-Signature');
            $event = null;

            try {
                $event = \Stripe\Webhook::constructEvent(
                    $payload, 
                    $sigHeader, 
                    config('services.stripe.webhook_secret')
                );
            } catch (\UnexpectedValueException $e) {
                return response('Invalid payload', 400);
            } catch (SignatureVerificationException $e) {
                return response('Invalid signature', 400);
            }

            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    $this->handleCompletedPayment($session);
                    break;
                    
                case 'checkout.session.expired':
                    $session = $event->data->object;
                    $this->handleExpiredSession($session);
                    break;
                    
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    $this->handleSuccessfulPaymentIntent($paymentIntent);
                    break;
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    protected function handleCompletedPayment($session)
    {
        // Handle completed payment webhook
    }

    protected function handleExpiredSession($session)
    {
        // Handle expired session
    }

    protected function handleSuccessfulPaymentIntent($paymentIntent)
    {
        // Handle successful payment intent
    }

    protected function createOrder($user, $cartItems, $total, $paymentMethod)
    {
        return DB::transaction(function () use ($user, $cartItems, $total, $paymentMethod) {
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'status' => $paymentMethod === 'stripe' ? 'pending' : 'completed',
                'payment_method' => $paymentMethod,
                'shipping_address' => $user->profile->shipping_address ?? '',
                'billing_address' => $user->profile->billing_address ?? '',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $user->cartItems()->delete();

            return $order;
        });
    }
}