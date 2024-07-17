<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerReport;
use App\Models\ServiceProviderReport;
use App\Models\BlacklistedServiceProvider;
use App\Models\Customer; // Add this line to import the Customer class
use App\Models\BlacklistedCustomer; // Add this line to import the BlacklistedCustomer class
use App\Models\ServiceProvider; // Add this line to import the ServiceProvider class

class AdminAuthController extends Controller
{
    public function showLoginForm(){
        return view('auth/admin_login');
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::guard('system_administrator')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    public function reports()
    {
        $customerReports = CustomerReport::all();
        $serviceProviderReports = ServiceProviderReport::all();
        
        return view('/admin/admin_showreports', compact('customerReports', 'serviceProviderReports'));
    }
    public function banCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        BlacklistedCustomer::create([
            'customer_id' => $customer->id,
            'email' => $customer->email,
            'phone_number' => $customer->phone_number,
            'reason' => 'Banned by admin',
        ]);

        $customer->delete();

        return redirect()->route('admin.manageUsers')->with('success', 'Customer banned and deleted successfully.');
    }

    // Ban and delete a service provider
    public function banServiceProvider($id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);

        BlacklistedServiceProvider::create([
            'service_provider_id' => $serviceProvider->id,
            'email' => $serviceProvider->email,
            'phone_number' => $serviceProvider->phone_number,
            'reason' => 'Banned by admin',
        ]);

        $serviceProvider->delete();

        return redirect()->route('admin.manageUsers')->with('success', 'Service provider banned and deleted successfully.');
    }

    // Method to show manage users page
    public function manageUsers()
    {
        $customers = Customer::all();
        $serviceProviders = ServiceProvider::all();

        return view('admin.manage_users', compact('customers', 'serviceProviders'));
    }
    
}
