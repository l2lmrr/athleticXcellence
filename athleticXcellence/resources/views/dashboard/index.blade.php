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
    <title>Admin Dashboard | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-box"></i>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Products</p>
                                <h3 class="text-2xl font-bold">{{ $stats['total_products'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Users</p>
                                <h3 class="text-2xl font-bold">{{ $stats['total_users'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Orders</p>
                                <h3 class="text-2xl font-bold">{{ $stats['total_orders'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div>
                                <p class="text-gray-500">Total Revenue</p>
                                <h3 class="text-2xl font-bold">${{ number_format($stats['total_revenue'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Order Status Chart -->
                    <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                        <h3 class="text-lg font-semibold mb-4">Order Status</h3>
                        <canvas id="orderStatusChart" height="200"></canvas>
                    </div>

                    <!-- Low Stock Alerts -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Low Stock Alerts</h3>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ $stats['low_stock'] }} items
                            </span>
                        </div>
                        <div class="space-y-4">
                            @foreach(Product::where('stock', '<', 5)->latest()->take(3)->get() as $product)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-md overflow-hidden mr-3">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium">{{ $product->name }}</h4>
                                        <p class="text-xs text-gray-500">Only {{ $product->stock }} left in stock</p>
                                    </div>
                                </div>
                            @endforeach
                            @if($stats['low_stock'] > 3)
                                <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    View all {{ $stats['low_stock'] }} low stock items
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <h3 class="text-lg font-semibold mb-4">Most Popular Products</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @foreach($popularProducts as $product)
                            <div class="text-center">
                                <div class="h-24 bg-gray-200 rounded-md overflow-hidden mx-auto mb-2">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                </div>
                                <h4 class="text-sm font-medium">{{ $product->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $product->total_sold }} sold</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Recent Orders</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($recentOrders as $order)
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium">Order #{{ $order->id }}</h4>
                                        <p class="text-sm text-gray-500">{{ $order->user->name }} • {{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium">${{ number_format($order->total_amount, 2) }}</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($order->status === 'completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-4 border-t border-gray-200">
                        <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                            View all orders
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Order Status Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($orderStatuses->pluck('status')) !!},
                datasets: [{
                    data: {!! json_encode($orderStatuses->pluck('count')) !!},
                    backgroundColor: [
                        '#10B981', // green for completed
                        '#F59E0B', // yellow for pending
                        '#EF4444', // red for cancelled
                        '#3B82F6', // blue for processing
                        '#8B5CF6'  // purple for shipped
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    </script>
</body>
</html>