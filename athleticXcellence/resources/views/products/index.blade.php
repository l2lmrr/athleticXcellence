<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Filters and Search -->
            <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <h1 class="text-2xl font-bold text-gray-900">Our Products</h1>
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <form action="{{ route('products.index') }}" method="GET" class="flex-1">
                        <input type="text" name="search" placeholder="Search products..." 
                               value="{{ request('search') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                    </form>
                    
                    <form action="{{ route('products.index') }}" method="GET" class="w-full md:w-48">
                        <select name="category" onchange="this.form.submit()" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            @if($products->isEmpty())
                <div class="bg-white shadow rounded-lg p-8 text-center">
                    <p class="text-gray-500">No products found matching your criteria.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                        Reset Filters
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                            <a href="{{ route('products.show', $product) }}" class="block">
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            </a>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            <a href="{{ route('products.show', $product) }}" class="hover:text-gray-700">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">{{ $product->category->name }}</p>
                                    </div>
                                    <p class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                                </div>
                                
                                @auth
                                    <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button onclick="showLoginModal()" class="w-full px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors mt-4">
                                        Add to Cart
                                    </button>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Login Modal (hidden by default) -->
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