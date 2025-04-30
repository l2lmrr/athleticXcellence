@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Shipping Information</h2>
                    
                    <form method="POST" action="{{ route('checkout') }}">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input id="first_name" name="first_name" type="text" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input id="last_name" name="last_name" type="text" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- More form fields -->
                        
                        <h2 class="text-xl font-bold text-gray-900 mt-8 mb-6">Payment Method</h2>
                        
                        <!-- Payment options -->
                        
                        <button type="submit" class="w-full py-3 px-4 bg-black text-white font-medium rounded-lg hover:bg-gray-900 transition-colors mt-6">
                            Complete Order
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div>
                <div class="bg-white shadow rounded-lg p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                        <div class="py-4 flex justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $item->name }}</h3>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">${{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Subtotal</span>
                            <span class="text-sm font-medium">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Shipping</span>
                            <span class="text-sm font-medium">$5.00</span>
                        </div>
                        <div class="flex justify-between font-medium text-lg mt-4 pt-4 border-t border-gray-200">
                            <span>Total</span>
                            <span>${{ number_format($subtotal + 5, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection