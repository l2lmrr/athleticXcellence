<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Canceled | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white rounded-lg shadow-md overflow-hidden p-8 text-center">
                <div class="mb-6">
                    <svg class="w-16 h-16 text-yellow-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Canceled</h1>
                <p class="text-lg text-gray-600 mb-6">Your order #{{ $order->id }} was not completed.</p>
                
                <div class="bg-gray-50 p-6 rounded-lg mb-8 text-left">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                        <div class="flex justify-between">
                            <span>{{ $item->product->name }} (x{{ $item->quantity }}, Size: {{ $item->size }})</span>
                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                        @endforeach
                        <div class="border-t border-gray-200 pt-3 mt-3 font-bold">
                            <div class="flex justify-between">
                                <span>Total</span>
                                <span>${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('checkout') }}" class="px-6 py-3 bg-black text-white rounded-md hover:bg-gray-800 transition-colors">
                        Return to Checkout
                    </a>
                    <a href="{{ route('products.index') }}" class="px-6 py-3 border border-black text-black rounded-md hover:bg-gray-100 transition-colors">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>