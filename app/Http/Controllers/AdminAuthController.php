<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerReport;
use App\Models\ServiceProviderReport;

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
        $reports = CustomerReport::all();
        $reports = ServiceProviderReport::all();
        
        return view('admin.reports', compact('customerReports', 'serviceProviderReports'));
    }

    
}
