@php
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-xl font-bold">ATHLETICXCELLENCE</h1>
                <p class="text-gray-400 text-sm">Admin Dashboard</p>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-box mr-3"></i> Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-tags mr-3"></i> Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-users mr-3"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-shopping-cart mr-3"></i> Orders
                        </a>
                    </li>
                    <li class="mt-8 pt-4 border-t border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center p-2 rounded hover:bg-gray-700 w-full">
                                <i class="fas fa-sign-out-alt mr-3"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Order #{{ $order->id }}</h2>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-600 cursor-pointer"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </div>
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow p-6 mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium">Order Items</h3>
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                    @if($order->status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <div class="py-4 flex">
                                    <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden mr-4">
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                        <p class="text-xs text-gray-500">${{ number_format($item->price, 2) }} each</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-medium mb-4">Order History</h3>
                            <div class="space-y-4">
                                <!-- Initial status entry -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium">{{ $order->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->created_at->format('M j, Y g:i a') }}</p>
                                        </div>
                                        <p class="text-sm text-gray-700">Order created with status: <span class="font-medium">{{ ucfirst($order->status) }}</span></p>
                                    </div>
                                </div>
                        
                                <!-- Status updates -->
                                @foreach($order->statusHistory as $update)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                        {{ strtoupper(substr($update->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium">{{ $update->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $update->created_at->format('M j, Y g:i a') }}</p>
                                        </div>
                                        <p class="text-sm text-gray-700">Changed status to <span class="font-medium">{{ ucfirst($update->status) }}</span></p>
                                        @if($update->note)
                                            <div class="mt-1 p-2 bg-gray-100 rounded text-sm">
                                                {{ $update->note }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="bg-white rounded-lg shadow p-6 mb-6">
                            <h3 class="text-lg font-medium mb-4">Order Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span>${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span>${{ number_format($order->shipping_cost, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tax</span>
                                    <span>${{ number_format($order->tax, 2) }}</span>
                                </div>
                                <div class="border-t border-gray-200 pt-2 mt-2 flex justify-between font-medium">
                                    <span>Total</span>
                                    <span>${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6 mb-6">
                            <h3 class="text-lg font-medium mb-4">Customer Information</h3>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-sm font-medium">{{ $order->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Shipping Address</p>
                                    <p class="text-sm text-gray-600 whitespace-pre-line">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-medium mb-4">Update Status</h3>
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <select name="status" id="status" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <textarea name="note" id="note" rows="3" placeholder="Add a note (optional)"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"></textarea>
                                </div>
                                <button type="submit" class="w-full px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                    Update Order Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>