<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_products' => Product::count(),
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'low_stock' => Product::where('stock', '<', 5)->count(),
        ];

        // Recent orders
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Most popular products
        $popularProducts = DB::table('order_items')
            ->select('product_id', 'products.name', 'products.image_path', DB::raw('SUM(quantity) as total_sold'))
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->groupBy('product_id', 'products.name', 'products.image_path')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Order status counts
        $orderStatuses = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return view('dashboard.index', compact('stats', 'recentOrders', 'popularProducts', 'orderStatuses'));
    }
}