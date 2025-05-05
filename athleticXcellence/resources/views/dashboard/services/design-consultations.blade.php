@php
use App\Models\DesignConsultation;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Consultations | ATHLETICXCELLENCE</title>
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
                    <li>
                        <a href="{{ route('admin.service-requests') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-laptop-code mr-3"></i> Service Requests
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.design-consultations') }}" class="flex items-center p-2 rounded bg-gray-700">
                            <i class="fas fa-pencil-ruler mr-3"></i> Design Consultations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.quote-requests') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                            <i class="fas fa-file-invoice-dollar mr-3"></i> Quote Requests
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
                    <h2 class="text-xl font-semibold text-gray-800">Design Consultations</h2>
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
                <div class="bg-white shadow rounded-lg p-6">
                    <!-- Filters -->
                    <div class="mb-6">
                        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="">All Statuses</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">From Date</label>
                                <input type="date" name="date_from" value="{{ request('date_from') }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Filter
                                </button>
                                <a href="{{ route('admin.design-consultations') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Consultations Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products Needed</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($consultations as $consultation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $consultation->first_name }} {{ $consultation->last_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $consultation->organization ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $consultation->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $consultation->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @foreach(json_decode($consultation->products_needed) as $product)
                                                {{ $product }}@if(!$loop->last), @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $consultation->status == 'new' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($consultation->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                               'bg-blue-100 text-blue-800') }}">
                                            {{ str_replace('_', ' ', $consultation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $consultation->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.design-consultations.show', $consultation) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <form action="{{ route('admin.design-consultations.update-status', $consultation) }}" method="POST" class="inline">                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status }}" {{ $consultation->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $consultations->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>