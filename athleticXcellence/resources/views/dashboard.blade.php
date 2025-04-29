@extends('layouts.app')

@section('content')
    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Dashboard Cards -->
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        <h3 class="text-lg font-medium text-blue-800">Total Users</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalUsers ?? 0 }}</p>
                    </div>
                    
                    <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                        <h3 class="text-lg font-medium text-green-800">Active Subscriptions</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $activeSubscriptions ?? 0 }}</p>
                    </div>
                    
                    <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                        <h3 class="text-lg font-medium text-purple-800">Revenue</h3>
                        <p class="text-3xl font-bold text-purple-600 mt-2">${{ number_format($revenue ?? 0, 2) }}</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <a href="{{ route('welcome') }}" class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection