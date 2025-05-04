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
    <a href="{{ route('services') }}" class="text-white hover:text-gray-300 transition-colors">Services</a>
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
        <span id="cart-count" class="absolute -top-1 -right-1 bg-white text-black rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
          {{ auth()->user()->cartItems()->count() }}
        </span>
      </button>

      <!-- Cart Dropdown -->
      <div x-show="openCart"
           @click.away="openCart = false"
           x-transition
           class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-20 border border-gray-200 origin-top-right overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">Your Cart (<span id="dropdown-cart-count">{{ auth()->user()->cartItems()->count() }}</span>)</h3>
        </div>
        
        <div id="cart-items-container">
            @if(auth()->user()->cartItems()->count() > 0)
                <div class="max-h-96 overflow-y-auto">
                    @foreach(auth()->user()->cartItems()->with('product')->latest()->get() as $item)
                        <div class="p-4 border-b border-gray-200 flex items-center cart-item" data-id="{{ $item->id }}">
                            <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-md overflow-hidden">
                                <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                            </div>
                            <div class="ml-3 flex-1">
                                <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                <div class="flex items-center mt-1">
                                    <button class="decrease-quantity text-gray-500 hover:text-black" 
                                            data-id="{{ $item->id }}"
                                            @if($item->quantity <= 1) disabled @endif>
                                        -
                                    </button>
                                    <span class="mx-2 text-sm quantity">{{ $item->quantity }}</span>
                                    <button class="increase-quantity text-gray-500 hover:text-black" 
                                            data-id="{{ $item->id }}"
                                            @if($item->quantity >= $item->product->stock) disabled @endif>
                                        +
                                    </button>
                                </div>
                                <p class="text-sm font-medium text-gray-900 mt-1 item-total">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                            </div>
                            <form class="remove-item-form" action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 text-gray-400 hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-between mb-4">
                        <span class="font-medium">Subtotal:</span>
                        <span class="font-medium" id="cart-subtotal">${{ number_format(auth()->user()->cartItems()->with('product')->get()->sum(function($item) { return $item->product->price * $item->quantity; }), 2) }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="block w-full text-center py-2 px-4 bg-black text-white rounded-md hover:bg-gray-900 transition-colors">
                        Proceed to Checkout
                    </a>
                </div>
            @else
                <div class="p-4 text-center text-gray-500">
                    Your cart is empty
                </div>
            @endif
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity updates
    document.querySelectorAll('.increase-quantity, .decrease-quantity').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const itemId = this.getAttribute('data-id');
            const isIncrease = this.classList.contains('increase-quantity');
            const quantityElement = this.parentElement.querySelector('.quantity');
            let newQuantity = parseInt(quantityElement.textContent);
            
            newQuantity = isIncrease ? newQuantity + 1 : newQuantity - 1;
            
            fetch(`/cart/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update quantity display
                    quantityElement.textContent = newQuantity;
                    
                    // Update item total
                    const itemTotalElement = this.closest('.cart-item').querySelector('.item-total');
                    itemTotalElement.textContent = '$' + (data.item_price * newQuantity).toFixed(2);
                    
                    // Update cart count in navbar
                    document.getElementById('cart-count').textContent = data.cart_count;
                    document.getElementById('dropdown-cart-count').textContent = data.cart_count;
                    
                    // Update subtotal
                    document.getElementById('cart-subtotal').textContent = '$' + data.subtotal.toFixed(2);
                    
                    // Update disabled states
                    const decreaseBtn = this.closest('.cart-item').querySelector('.decrease-quantity');
                    const increaseBtn = this.closest('.cart-item').querySelector('.increase-quantity');
                    decreaseBtn.disabled = newQuantity <= 1;
                    increaseBtn.disabled = newQuantity >= data.product_stock;
                }
            });
        });
    });

    // Handle item removal
    document.querySelectorAll('.remove-item-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch(this.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove item from DOM
                    this.closest('.cart-item').remove();
                    
                    // Update cart count in navbar
                    document.getElementById('cart-count').textContent = data.cart_count;
                    document.getElementById('dropdown-cart-count').textContent = data.cart_count;
                    
                    // Update subtotal
                    document.getElementById('cart-subtotal').textContent = '$' + data.subtotal.toFixed(2);
                    
                    // If cart is empty, show empty message
                    if (data.cart_count === 0) {
                        document.getElementById('cart-items-container').innerHTML = `
                            <div class="p-4 text-center text-gray-500">
                                Your cart is empty
                            </div>
                        `;
                    }
                }
            });
        });
    });
});
</script>
</body>
</html>