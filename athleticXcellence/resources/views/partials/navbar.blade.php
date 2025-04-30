<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        .animate-fade {
            animation: fade 0.2s ease-in-out;
        }
        @keyframes fade {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<nav class="fixed top-0 left-0 w-full flex items-center justify-between px-10 py-4 bg-black/80 backdrop-blur-sm z-50 border-b border-gray-800">
    <!-- Logo -->
    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-white">
        ATHLETIC<span class="text-gray-400">XCELLENCE</span>
    </a>
    
    <!-- Navigation Links -->
    <div class="flex space-x-8 text-lg">
        <a href="{{ route('welcome') }}" class="text-white hover:text-gray-300 transition-colors">Home</a>
        <a href="{{ route('products.index') }}" class="text-white hover:text-gray-300 transition-colors">Shop</a>
        <a href="#" class="text-white hover:text-gray-300 transition-colors">Services</a>
        <a href="#" class="text-white hover:text-gray-300 transition-colors">About</a>
    </div>
    
    <!-- Right Side -->
    <div class="flex items-center space-x-6">
        <!-- Search Bar -->
        <div class="relative">
            <input type="text" class="bg-transparent border border-white rounded-full px-4 py-1.5 text-sm text-white focus:outline-none focus:border-gray-400 placeholder-gray-300" placeholder="Search">
        </div>

        @auth
            <!-- Cart Dropdown -->
            <div class="relative" x-data="{ openCart: false }">
                <button @click="openCart = !openCart" class="p-2 text-white hover:text-gray-300 transition-colors relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-text="$store.cart.count" class="absolute -top-1 -right-1 bg-white text-black rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold"></span>
                </button>
                
                <!-- Cart Dropdown Content -->
                <div x-show="openCart" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.away="openCart = false"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-20 border border-gray-200 overflow-hidden origin-top-right">
                    <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">Your Cart</h3>
                    </div>
                    
                    <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto" x-data="$store.cart">
                        <template x-for="item in items" :key="item.id">
                            <div class="p-4 flex items-center hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                    <img :src="item.image" :alt="item.name" class="h-full w-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <h4 class="text-sm font-medium text-gray-900" x-text="item.name"></h4>
                                        <p class="text-sm font-medium text-gray-900">$<span x-text="(item.price * item.quantity).toFixed(2)"></span></p>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <div class="flex items-center border border-gray-300 rounded-md">
                                            <button @click="updateQuantity(item.id, item.quantity - 1)" class="px-2 py-1 text-gray-600 hover:text-black">-</button>
                                            <span class="px-2" x-text="item.quantity"></span>
                                            <button @click="updateQuantity(item.id, item.quantity + 1)" class="px-2 py-1 text-gray-600 hover:text-black">+</button>
                                        </div>
                                        <button @click="removeItem(item.id)" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="items.length === 0">
                            <div class="p-4 text-center text-gray-500">Your cart is empty</div>
                        </template>
                    </div>
                    
                    <div class="p-4 border-t border-gray-200 bg-gray-50" x-data="$store.cart">
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">$<span x-text="total.toFixed(2)"></span></span>
                        </div>
                        <a href="{{ route('checkout') }}" class="block w-full text-center py-2 px-4 bg-black text-white rounded-md hover:bg-gray-900 transition-colors">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="relative" x-data="{ openUser: false }">
                <button @click="openUser = !openUser" class="flex items-center space-x-2 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <svg class="w-4 h-4 text-white transition-transform duration-200" :class="{ 'transform rotate-180': openUser }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="openUser" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.away="openUser = false"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 border border-gray-200 overflow-hidden origin-top-right">
                    <a href="{{ route('profile') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors border-b border-gray-200">
                        My Profile
                    </a>
                    <a href="{{ route('orders') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors border-b border-gray-200">
                        My Orders
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Dynamic Auth Button -->
            @if(request()->is('login'))
                <a href="{{ route('register') }}" class="px-4 py-1.5 bg-white text-black rounded-full hover:bg-gray-100 transition-colors text-sm">
                    Sign Up
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-1.5 border border-white rounded-full text-white hover:bg-white hover:text-black transition-colors text-sm">
                    Sign In
                </a>
            @endif
        @endauth
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', {
            items: [],
            count: 0,
            total: 0,

            init() {
                this.loadCart();
            },

            loadCart() {
                // Fetch cart items from server or localStorage
                // This is a placeholder - implement your actual cart logic
                this.items = [
                    {id: 1, name: 'Training Program', price: 99.99, quantity: 1, image: 'https://via.placeholder.com/150'},
                    {id: 2, name: 'Protein Powder', price: 49.99, quantity: 2, image: 'https://via.placeholder.com/150'}
                ];
                this.updateTotals();
            },

            updateQuantity(id, newQuantity) {
                const item = this.items.find(item => item.id === id);
                if (item) {
                    if (newQuantity < 1) {
                        this.removeItem(id);
                    } else {
                        item.quantity = newQuantity;
                        this.updateTotals();
                        // Send update to server here
                    }
                }
            },

            removeItem(id) {
                this.items = this.items.filter(item => item.id !== id);
                this.updateTotals();
                // Send removal to server here
            },

            updateTotals() {
                this.count = this.items.reduce((sum, item) => sum + item.quantity, 0);
                this.total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            }
        });
    });
</script>