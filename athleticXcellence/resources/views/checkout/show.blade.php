<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                            <div class="py-4 flex justify-between">
                                <div class="flex items-center">
                                    <div class="h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <div class="flex items-center mt-1">
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" 
                                                        class="px-2 py-1 text-gray-600 hover:bg-gray-100 rounded-l"
                                                        @if($item->quantity <= 1) disabled @endif>
                                                    -
                                                </button>
                                                <span class="px-2 py-1 bg-gray-50 text-sm">{{ $item->quantity }}</span>
                                                <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" 
                                                        class="px-2 py-1 text-gray-600 hover:bg-gray-100 rounded-r"
                                                        @if($item->quantity >= $item->product->stock) disabled @endif>
                                                    +
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                    <form action="{{ route('cart.destroy', $item) }}" method="POST" class="mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-800">Remove</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="border-t border-gray-200 mt-6 pt-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>${{ number_format($total, 2) }}</p>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mt-1">
                                <p>Shipping</p>
                                <p>Free</p>
                            </div>
                            <div class="flex justify-between text-lg font-medium text-gray-900 mt-4">
                                <p>Total</p>
                                <p>${{ number_format($total, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h2>
                        <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                                <textarea id="shipping_address" name="shipping_address" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    rows="3">{{ old('shipping_address', auth()->user()->profile->shipping_address ?? '') }}</textarea>
                                @error('shipping_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-1">Billing Address</label>
                                <textarea id="billing_address" name="billing_address"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                                    rows="3">{{ old('billing_address', auth()->user()->profile->billing_address ?? '') }}</textarea>
                                @error('billing_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                                <select id="payment_method" name="payment_method" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                                    <option value="stripe">Credit/Debit Card (Stripe)</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>
                            
                            <div class="mt-6">
                                <button type="submit" class="w-full px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-900 transition-colors">
                                    Complete Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>