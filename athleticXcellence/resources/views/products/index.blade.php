<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Filters and Sorting -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <h1 class="text-3xl font-bold text-gray-900">Our Products</h1>
                
                <div class="flex items-center space-x-4 w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <select class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-white shadow-sm focus:outline-none focus:ring-black focus:border-black">
                            <option>All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="relative w-full md:w-48">
                        <select class="block w-full px-4 py-2 border border-gray-300 rounded-md bg-white shadow-sm focus:outline-none focus:ring-black focus:border-black">
                            <option>Sort by: Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest Arrivals</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <div class="h-64 bg-gray-200 overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        </a>
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $product->category->name }}</p>
                                </div>
                                <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                            </div>
                            
                            <div class="mt-4">
                                @if($product->stock > 0)
                                    <span class="text-sm text-green-600">In Stock ({{ $product->stock }})</span>
                                @else
                                    <span class="text-sm text-red-600">Out of Stock</span>
                                @endif
                                
                                @auth
                                    <form class="mt-3 add-to-cart-form" data-product-id="{{ $product->id }}">
                                        @csrf
                                        <div class="mb-2">
                                            <label for="size-{{ $product->id }}" class="sr-only">Size</label>
                                            <select name="size" id="size-{{ $product->id }}" class="w-full px-2 py-1 border border-gray-300 rounded text-sm">
                                                <option value="S">Small (S)</option>
                                                <option value="M" selected>Medium (M)</option>
                                                <option value="L">Large (L)</option>
                                                <option value="XL">Extra Large (XL)</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="quantity-{{ $product->id }}" class="sr-only">Quantity</label>
                                            <select name="quantity" id="quantity-{{ $product->id }}" class="w-full px-2 py-1 border border-gray-300 rounded text-sm">
                                                @for($i = 1; $i <= min(10, $product->stock); $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <button type="submit" 
                                                class="w-full px-3 py-1.5 bg-black text-white text-sm rounded hover:bg-gray-800 transition-colors add-to-cart-btn"
                                                @if($product->stock <= 0) disabled @endif>
                                            Add to Cart
                                        </button>
                                        <div class="mt-2 text-sm text-green-600 success-message hidden">
                                            Added to cart!
                                        </div>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="block w-full text-center px-3 py-1.5 bg-black text-white text-sm rounded hover:bg-gray-800 transition-colors mt-3">
                                        Add to Cart
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    @include('partials.footer')

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const size = this.querySelector('select[name="size"]').value;
            const quantity = this.querySelector('select[name="quantity"]').value;
            const button = this.querySelector('.add-to-cart-btn');
            const successMessage = this.querySelector('.success-message');
            
            button.disabled = true;
            button.textContent = 'Adding...';
            
            axios.post(`/cart/${productId}`, {
                size: size,
                quantity: quantity,
                _token: this.querySelector('input[name="_token"]').value
            })
            .then(response => {
                button.textContent = 'Added to Cart';
                successMessage.classList.remove('hidden');
                
                document.getElementById('cart-count').textContent = response.data.cart_count;
                document.getElementById('dropdown-cart-count').textContent = response.data.cart_count;
                
                setTimeout(() => {
                    button.textContent = 'Add to Cart';
                    button.disabled = false;
                    successMessage.classList.add('hidden');
                }, 2000);
            })
            .catch(error => {
                console.error(error);
                button.textContent = 'Error - Try Again';
                button.disabled = false;
            });
        });
    });
});
    </script>
</body>
</html>