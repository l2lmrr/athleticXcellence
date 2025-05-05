@php
use App\Models\DesignConsultation;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Consultation Details | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar (same as your design-consultations.blade.php) -->
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
                <a href="{{ route('admin.service-requests') }}" class="flex items-center p-2 rounded bg-gray-700">
                    <i class="fas fa-laptop-code mr-3"></i> Service Requests
                </a>
            </li>
            <li>
                <a href="{{ route('admin.design-consultations') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
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
                    <h2 class="text-xl font-semibold text-gray-800">Design Consultation Details</h2>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Client Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Client Information</h3>
                            <div class="space-y-3">
                                <p><span class="font-medium">Name:</span> {{ $consultation->first_name }} {{ $consultation->last_name }}</p>
                                <p><span class="font-medium">Organization:</span> {{ $consultation->organization ?? 'N/A' }}</p>
                                <p><span class="font-medium">Email:</span> {{ $consultation->email }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $consultation->phone }}</p>
                            </div>
                        </div>
                        
                        <!-- Project Details -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Project Details</h3>
                            <div class="space-y-3">
                                <p>
                                    <span class="font-medium">Products Needed:</span> 
                                    @foreach(json_decode($consultation->products_needed) as $product)
                                        {{ $product }}@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                                <p><span class="font-medium">Quantity:</span> {{ $consultation->quantity }}</p>
                                <p>
                                    <span class="font-medium">Deadline:</span> 
                                    {{ $consultation->deadline ? $consultation->deadline->format('M d, Y') : 'Not specified' }}
                                </p>
                                <p>
                                    <span class="font-medium">Status:</span> 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $consultation->status == 'new' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($consultation->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                           'bg-blue-100 text-blue-800') }}">
                                        {{ str_replace('_', ' ', $consultation->status) }}
                                    </span>
                                </p>
                                <p>
                                    <span class="font-medium">Submitted:</span> 
                                    {{ $consultation->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Design Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Design Details</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="whitespace-pre-line">{{ $consultation->design_details }}</p>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('admin.design-consultations') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                            <i class="fas fa-arrow-left mr-2"></i> Back to List
                        </a>
                        
                        <form action="{{ route('admin.design-consultations.update-status', $consultation) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center space-x-4">
                                <select name="status" class="text-sm border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ $consultation->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>