<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerLoginRequest;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(CustomerLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('test_working'));
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid email or password']);
    }
}
