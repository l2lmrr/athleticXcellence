<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'statusHistory'])->latest()->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'statusHistory.user']);
        return view('dashboard.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'note' => 'nullable|string|max:500'
        ]);

        // Create status history record
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'status' => $request->status,
            'note' => $request->note
        ]);

        // Update order status
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated!');
    }
}