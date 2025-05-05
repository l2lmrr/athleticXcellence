<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\DesignConsultation;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $stats = [
        'total_products' => Product::count(),
        'total_users' => User::count(),
        'total_orders' => Order::count(),
        'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        'low_stock' => Product::where('stock', '<', 5)->count(),
        'pending_service_requests' => ServiceRequest::where('status', 'new')->count(),
        'pending_design_consultations' => DesignConsultation::where('status', 'new')->count(),
        'pending_quote_requests' => QuoteRequest::where('status', 'new')->count(),
    ];

    $recentOrders = Order::with('user')->latest()->take(5)->get();

    $popularProducts = DB::table('order_items')
        ->select('product_id', 'products.name', 'products.image_path', DB::raw('SUM(quantity) as total_sold'))
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->groupBy('product_id', 'products.name', 'products.image_path')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

    $orderStatuses = Order::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();

    $recentServiceRequests = ServiceRequest::latest()->take(3)->get();
    $recentDesignConsultations = DesignConsultation::latest()->take(3)->get();
    $recentQuoteRequests = QuoteRequest::latest()->take(3)->get();

    $lowStockProducts = Product::where('stock', '<', 5)->latest()->take(3)->get();

    return view('dashboard.index', compact(
        'stats',
        'recentOrders',
        'popularProducts',
        'orderStatuses',
        'recentServiceRequests',
        'recentDesignConsultations',
        'recentQuoteRequests',
        'lowStockProducts'
    ));
}
public function serviceRequests()
{
    $requests = ServiceRequest::latest()
        ->filter(request(['status', 'project_type', 'date_from']))
        ->paginate(10);
    
    return view('dashboard.serviced.service-requests', [
        'requests' => $requests,
        'statuses' => ['new', 'in_review', 'contacted', 'completed', 'rejected'],
        'projectTypes' => ['team-website', 'ecommerce', 'athlete-portfolio', 'event-system', 'other']
    ]);
}

public function showServiceRequest(ServiceRequest $request)
{
    return view('admin.service-request-show', [
        'request' => $request,
        'statuses' => ['new', 'in_review', 'contacted', 'completed', 'rejected']
    ]);
}

public function updateServiceRequestStatus(Request $request, ServiceRequest $serviceRequest)
{
    $validated = $request->validate([
        'status' => 'required|in:new,in_review,contacted,completed,rejected'
    ]);
    
    $serviceRequest->update($validated);
    
    return back()->with('success', 'Status updated successfully');
}

// Design Consultations
public function designConsultations()
{
    $consultations = DesignConsultation::latest()
        ->filter(request(['status', 'date_from']))
        ->paginate(10);
    
    return view('admin.design-consultations', [
        'consultations' => $consultations,
        'statuses' => ['new', 'in_review', 'contacted', 'completed', 'rejected']
    ]);
}

public function showDesignConsultation(DesignConsultation $consultation)
{
    return view('admin.design-consultation-show', [
        'consultation' => $consultation,
        'statuses' => ['new', 'in_review', 'contacted', 'completed', 'rejected']
    ]);
}

public function updateDesignConsultationStatus(Request $request, DesignConsultation $consultation)
{
    $validated = $request->validate([
        'status' => 'required|in:new,in_review,contacted,completed,rejected'
    ]);
    
    $consultation->update($validated);
    
    return back()->with('success', 'Status updated successfully');
}

// Quote Requests
public function quoteRequests()
{
    $quotes = QuoteRequest::latest()
        ->filter(request(['status', 'date_from']))
        ->paginate(10);
    
    return view('admin.quote-requests', [
        'quotes' => $quotes,
        'statuses' => ['new', 'in_review', 'quoted', 'completed', 'rejected']
    ]);
}

public function showQuoteRequest(QuoteRequest $quote)
{
    return view('admin.quote-request-show', [
        'quote' => $quote,
        'statuses' => ['new', 'in_review', 'quoted', 'completed', 'rejected']
    ]);
}

public function updateQuoteRequestStatus(Request $request, QuoteRequest $quote)
{
    $validated = $request->validate([
        'status' => 'required|in:new,in_review,quoted,completed,rejected'
    ]);
    
    $quote->update($validated);
    
    return back()->with('success', 'Status updated successfully');
}


}
