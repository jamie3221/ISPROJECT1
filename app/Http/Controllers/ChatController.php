<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceProviderReport;
use App\Models\CustomerReport;

class ChatController extends Controller
{
    public function showChatForm(){
        return view('chat');
    }
    public function chat(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.dashboard');
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
