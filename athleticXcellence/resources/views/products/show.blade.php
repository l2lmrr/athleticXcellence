<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                    <!-- Product Image -->
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" 
                             class="w-full h-auto object-cover">
                    </div>
                    
                    <!-- Product Details -->
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                        <div class="flex items-center mt-2">
                            <span class="text-gray-500 text-sm">Category: {{ $product->category->name }}</span>
                            <span class="mx-2 text-gray-300">|</span>
                            <span class="text-gray-500 text-sm">In Stock: {{ $product->stock }}</span>
                        </div>
                        
                        <p class="text-3xl font-bold text-gray-900 mt-4">${{ number_format($product->price, 2) }}</p>
                        
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Description</h3>
                            <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                        </div>
                        
                        <!-- Size Selection (if applicable) -->
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900">Size</h3>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">S</button>
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">M</button>
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">L</button>
                                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">XL</button>
                            </div>
                        </div>
                        
                        <!-- Add to Cart -->
                        @auth
                            <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-8">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="px-3 py-2 text-gray-600 hover:text-black">-</button>
                                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                               class="w-16 text-center border-0 focus:ring-0">
                                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="px-3 py-2 text-gray-600 hover:text-black">+</button>
                                    </div>
                                    <button type="submit" class="flex-1 px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                        Add to Cart
                                    </button>
                                </div>
                            </form>
                        @else
                            <button onclick="showLoginModal()" class="w-full px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors mt-8">
                                Add to Cart
                            </button>
                        @endauth
                    </div>
                </div>
                
                <!-- Related Products -->
                @if($relatedProducts->count() > 0)
                    <div class="border-t border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">You may also like</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($relatedProducts as $related)
                                <a href="{{ route('products.show', $related) }}" class="group">
                                    <div class="bg-gray-100 rounded-lg overflow-hidden h-40">
                                        <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="mt-2">
                                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-gray-700">{{ $related->name }}</h3>
                                        <p class="text-sm font-bold text-gray-900">${{ number_format($related->price, 2) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Login Modal (same as index page) -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Login Required</h3>
                <button onclick="hideLoginModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6">You need to be logged in to add items to your cart.</p>
            <div class="flex justify-end space-x-4">
                <button onclick="hideLoginModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                    Cancel
                </button>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Login
                </a>
            </div>
        </div>
    </div>

    <script>
        function showLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function hideLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
        }
    </script>
</body>
</html>