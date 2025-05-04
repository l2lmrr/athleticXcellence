<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                        <p class="text-sm text-gray-500 mt-1">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            @if($order->status === 'completed') bg-green-100 text-green-800
                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Order Items</h2>
                        <div class="divide-y divide-gray-200">
                            @forelse($order->items ?? [] as $item)
                            <div class="py-4 flex justify-between">
                                <div class="flex items-center">
                                    <div class="h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                        <img src="{{ $item->product->image_url ?? '' }}" alt="{{ $item->product->name ?? 'Product image' }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name ?? 'Product name' }}</h3>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="py-4 text-center text-gray-500">
                                No items found in this order
                            </div>
                            @endforelse
                        </div>
                        
                        <div class="border-t border-gray-200 mt-6 pt-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mt-1">
                                <p>Shipping</p>
                                <p>Free</p>
                            </div>
                            <div class="flex justify-between text-lg font-medium text-gray-900 mt-4">
                                <p>Total</p>
                                <p>${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Shipping Information</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-700">{{ $order->shipping_address ?? 'No shipping address provided' }}</p>
                        </div>
                        
                        <h2 class="text-lg font-medium text-gray-900 mt-6 mb-4">Payment Method</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-700">
                                {{ $order->payment_method ? ucfirst(str_replace('_', ' ', $order->payment_method)) : 'No payment method specified' }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <a href="{{ route('orders.index') }}" class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-900 transition-colors">
                        Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>