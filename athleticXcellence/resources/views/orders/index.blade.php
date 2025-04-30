@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">My Orders</h1>
        
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Order #{{ $order->id }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-medium">${{ number_format($order->total_amount, 2) }}</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('orders.show', $order) }}" class="text-sm font-medium text-black hover:text-gray-700 transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    You haven't placed any orders yet.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection