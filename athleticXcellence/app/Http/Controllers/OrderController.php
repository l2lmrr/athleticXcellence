<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('orders.show', compact('order'));
    }

    public function receipt(Order $order)
    {
        $this->authorize('view', $order);
        $pdf = PDF::loadView('orders.receipt', compact('order'));
        return $pdf->download('receipt-order-'.$order->id.'.pdf');
    }
}