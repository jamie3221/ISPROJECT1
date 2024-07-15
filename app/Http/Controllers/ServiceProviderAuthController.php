<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\ServiceProvider;
class ServiceProviderAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth/login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::guard('service_providers')->attempt($credentials)) {
            return redirect()->route('test');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    public function showRegisterForm()
    {
        return view('auth/register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_provider_type' => 'required|in:individual,company',
            'first_name' => 'required_if:type,individual|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required_if:type,individual|string|max:255',
            'company_name' => 'required_if:type,company|string|max:255',
            'email' => 'required|email|unique:service_providers,email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        $serviceProvider = new ServiceProvider();
        if ($request->type == 'individual') {
            $serviceProvider->first_name = $request->first_name;
            $serviceProvider->middle_name = $request->middle_name;
            $serviceProvider->last_name = $request->last_name;
        } else {
            $serviceProvider->company_name = $request->company_name;
        }
        $serviceProvider->email = $request->email;
        $serviceProvider->phone_number = $request->phone_number;
        $serviceProvider->password = Hash::make($request->password);
        $serviceProvider->profile_picture = $profilePicturePath;
        $serviceProvider->type = $request->type;
        $serviceProvider->save();
        return redirect()->route('service_provider.login')->with('success', 'Registration successful. Please log in.');
    }
}
