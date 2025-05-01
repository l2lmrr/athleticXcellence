<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ATHLETICXCELLENCE</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
<nav class="fixed top-0 left-0 w-full flex items-center justify-between px-10 py-4 bg-black/80 backdrop-blur-sm z-50 border-b border-gray-800" x-data="{ openCart: false, openUser: false }">
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
    <!-- Cart Icon & Dropdown -->
    <div class="relative">
      <button @click="openCart = !openCart" class="p-2 text-white hover:text-gray-300 transition-colors relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        @if($cartItemCount = auth()->user()->cartItems()->count())
          <span class="absolute -top-1 -right-1 bg-white text-black rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
            {{ $cartItemCount }}
          </span>
        @endif
      </button>

      <!-- Dropdown Cart Content Placeholder -->
      <div x-show="openCart"
           @click.away="openCart = false"
           x-transition
           class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-20 border border-gray-200 origin-top-right overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
          <h3 class="text-lg font-medium text-gray-900">Your Cart</h3>
        </div>
        <div class="p-4 text-center text-gray-500">
          Cart preview not implemented here – use Alpine store or backend loop
        </div>
        <div class="p-4 border-t border-gray-200 bg-gray-50">
          <a href="{{ route('cart.index') }}" class="block w-full text-center py-2 px-4 bg-black text-white rounded-md hover:bg-gray-900 transition-colors">
            View Full Cart
          </a>
        </div>
      </div>
    </div>

    <!-- User Dropdown -->
    <div class="relative">
      <button @click="openUser = !openUser" class="flex items-center space-x-2 focus:outline-none">
        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white">
          {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <svg class="w-4 h-4 text-white transition-transform duration-200" :class="{ 'transform rotate-180': openUser }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>

      <div x-show="openUser"
           @click.away="openUser = false"
           x-transition
           class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 border border-gray-200 overflow-hidden origin-top-right">
        <a href="{{ route('profile') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-200">My Profile</a>
        <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-200">My Orders</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">Sign Out</button>
        </form>
      </div>
    </div>
    @else
    <!-- Guest Buttons -->
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
</body>
</html>
