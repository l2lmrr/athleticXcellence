<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\DesignConsultation;
use App\Models\QuoteRequest;

class ServicesController extends Controller
{

    public function getStarted()
    {
        return view('get-started');
    }

    public function designConsultation()
    {
        return view('design-consultation');
    }

    public function requestQuote()
    {
        return view('request-quote');
    }

    // Handle form submissions
    public function storeGetStarted(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'project_type' => 'required|string',
            'project_details' => 'required|string',
            'budget' => 'nullable|string'
        ]);

        ServiceRequest::create($validated);

        return redirect()->back()->with('success', 'Your service request has been submitted!');
    }

    public function storeDesignConsultation(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'products_needed' => 'required|array',
            'products_needed.*' => 'string',
            'design_details' => 'required|string',
            'quantity' => 'required|string',
            'deadline' => 'nullable|date'
        ]);

        $validated['products_needed'] = json_encode($validated['products_needed']);

        DesignConsultation::create($validated);

        return redirect()->back()->with('success', 'Your design consultation request has been submitted!');
    }

    public function storeQuoteRequest(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'apparel_types' => 'required|array',
            'apparel_types.*' => 'string',
            'quantity' => 'required|integer|min:1',
            'deadline' => 'nullable|date',
            'design_files' => 'nullable|file|mimes:jpg,png,pdf,ai,psd|max:2048',
            'additional_notes' => 'nullable|string'
        ]);

        $validated['apparel_types'] = json_encode($validated['apparel_types']);

        if ($request->hasFile('design_files')) {
            $path = $request->file('design_files')->store('quote-requests');
            $validated['design_files_path'] = $path;
        }

        QuoteRequest::create($validated);

        return redirect()->back()->with('success', 'Your quote request has been submitted!');
    }

    // Admin methods
    public function adminServiceRequests()
    {
        $requests = ServiceRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.service-requests', compact('requests'));
    }

    public function adminDesignConsultations()
    {
        $consultations = DesignConsultation::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.design-consultations', compact('consultations'));
    }

    public function adminQuoteRequests()
    {
        $quotes = QuoteRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.quote-requests', compact('quotes'));
    }

    public function updateStatus(Request $request, $type, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string'
        ]);

        switch ($type) {
            case 'service':
                $model = ServiceRequest::findOrFail($id);
                break;
            case 'design':
                $model = DesignConsultation::findOrFail($id);
                break;
            case 'quote':
                $model = QuoteRequest::findOrFail($id);
                break;
            default:
                abort(404);
        }

        $model->update(['status' => $validated['status']]);

        return back()->with('success', 'Status updated successfully');
    }
}