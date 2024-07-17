<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest; // Import the ServiceRequest class
use App\Models\Service; // Import the Service class
use Illuminate\Support\Facades\Auth; // Import the Auth class

class ServiceREquestController extends Controller
{
    public function store(Request $request, Service $service)
    {
        // Validate the request data
        $request->validate([
            // Add any additional validation rules if needed
        ]);

        // Create a new service request
        $serviceRequest = new ServiceRequest();
        $serviceRequest->service_id = $service->id;
        $serviceRequest->customer_id = Auth::guard('customer')->user()->id; // Assuming customer is logged in
        $serviceRequest->status = 'pending'; // Set initial status

        // Save the service request
        $serviceRequest->save();

        // Redirect back to the customer home page with a success message
        return redirect()->route('customer.home')->with('success', 'Service requested successfully.');
    }
}
