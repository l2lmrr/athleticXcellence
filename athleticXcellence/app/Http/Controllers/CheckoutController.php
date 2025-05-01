<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        DB::transaction(function () use ($user, $cartItems, $total, $request) {
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $user->profile->shipping_address ?? '',
                'billing_address' => $user->profile->billing_address ?? '',
            ]);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Clear the cart
            $user->cartItems()->delete();
        });

        return redirect()->route('orders.show', Order::latest()->first())
            ->with('success', 'Order placed successfully!');
    }
}