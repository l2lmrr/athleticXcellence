<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Images -->
                    <div class="p-4">
                        <div class="h-96 bg-gray-200 rounded-lg overflow-hidden mb-4">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                                <p class="text-lg text-gray-500 mt-2">{{ $product->category->name }}</p>
                            </div>
                            <span class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                        </div>
                        
                        <div class="mt-6">
                            <div class="flex items-center">
                                @if($product->stock > 0)
                                    <span class="text-sm text-green-600">In Stock ({{ $product->stock }} available)</span>
                                @else
                                    <span class="text-sm text-red-600">Out of Stock</span>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <h3 class="text-sm font-medium text-gray-900">Description</h3>
                                <div class="mt-2 text-sm text-gray-700">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            
                            @auth
                            <form action="{{ route('cart.store', $product) }}" method="POST" class="mt-8">
                                @csrf
                                <div class="mb-4">
                                    <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                                    <select name="size" id="size" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                                        <option value="S">Small (S)</option>
                                        <option value="M" selected>Medium (M)</option>
                                        <option value="L">Large (L)</option>
                                        <option value="XL">Extra Large (XL)</option>
                                    </select>
                                </div>
                                
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border border-gray-300 rounded-md">
                                        <button type="button" 
                                                class="px-3 py-2 text-gray-600 hover:bg-gray-100"
                                                onclick="this.parentNode.querySelector('[type=number]').stepDown()">
                                            -
                                        </button>
                                        <input type="number" 
                                               name="quantity" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $product->stock }}"
                                               class="w-16 px-2 py-2 text-center border-0 focus:ring-0">
                                        <button type="button" 
                                                class="px-3 py-2 text-gray-600 hover:bg-gray-100"
                                                onclick="this.parentNode.querySelector('[type=number]').stepUp()">
                                            +
                                        </button>
                                    </div>
                                    
                                    <button type="submit" 
                                            class="px-6 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition-colors"
                                            @if($product->stock <= 0) disabled @endif>
                                        Add to Cart
                                    </button>
                                </div>
                            </form>
                            @else
                            <div class="mt-8">
                                <a href="{{ route('login') }}" class="px-6 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition-colors inline-block">
                                    Sign In to Purchase
                                </a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Products -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">You May Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <a href="{{ route('products.show', $related) }}" class="block">
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                                </div>
                            </a>
                            
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <a href="{{ route('products.show', $related) }}">{{ $related->name }}</a>
                                </h3>
                                <p class="text-lg font-bold text-gray-900 mt-2">${{ number_format($related->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>