<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CustomerAuthController extends Controller
{
    public function showLoginForm(){
        return view('auth.customer_login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::guard('customer')->attempt($credentials)){
            return redirect()->route('test_working');
        }else{
            return back()->withInput($request->only('email'))->withErrors(['email' => 'Invalid email or password']);
        }	
    }
}
