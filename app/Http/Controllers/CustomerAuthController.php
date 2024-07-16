<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
class CustomerAuthController extends Controller
{
    public function showLoginForm(){
        return view('auth/login');
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
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.home');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    public function showRegisterForm()
    {
        return view('auth/register');
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required',
            'password' => 'required|min:6',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $profilePicturePath = $request->file('profile_picture')->store('public/profile_pictures');
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'profile_picture' => $profilePicturePath,
        ]);
        return redirect()->route('test')->with('success', 'Account created successfully');
    }
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function showDashboard()
    {
        $customer = Auth::guard('customer')->user();
        
        return view('customer_dashboard', compact('customer'));
    }

}