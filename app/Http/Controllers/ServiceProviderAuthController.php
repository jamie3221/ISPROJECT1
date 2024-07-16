<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\ServiceProvider;
use App\Models\ServiceRequest;
use App\Models\Service; // Add this line to import the Service class
class ServiceProviderAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth/login');
    }
    public function login(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to authenticate the service provider using credentials
        $credentials = $request->only('email', 'password');
        if (Auth::guard('service_provider')->attempt($credentials)) {
            // Authentication successful, redirect to service provider's home page
            return redirect()->route('service_provider.home');
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    public function showRegisterForm()
    {
        return view('auth/register');
    }
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'service_provider_type' => 'required|in:individual,business',
        'first_name' => 'required_if:service_provider_type,individual|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required_if:service_provider_type,individual|string|max:255',
        'business_name' => 'required_if:service_provider_type,business|string|max:255',
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

    if ($request->service_provider_type == 'individual') {
        $serviceProvider->first_name = $request->first_name;
        $serviceProvider->middle_name = $request->middle_name;
        $serviceProvider->last_name = $request->last_name;
        $serviceProvider->service_provider_type = 'individual';
    } else {
        $serviceProvider->business_name = $request->business_name;
        $serviceProvider->service_provider_type = 'business';
    }

    $serviceProvider->email = $request->email;
    $serviceProvider->phone_number = $request->phone_number;
    $serviceProvider->password = Hash::make($request->password);
    $serviceProvider->profile_picture = $profilePicturePath;

    $serviceProvider->save();

    return redirect()->route('service_provider.login')->with('success', 'Registration successful. Please log in.');
}

    public function showServiceProviderHome()
    {
        $serviceProvider = Auth::guard('service_provider')->user();
        
        $serviceRequests = ServiceRequest::where('service_provider_id', $serviceProvider->service_provider_id)
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $services = Service::where('service_provider_id', $serviceProvider->service_provider_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('service_provider.home', compact('serviceProvider', 'serviceRequests', 'services'));
    }
    public function logout()
    {
        Auth::guard('service_provider')->logout();
        return redirect()->route('home');
    }
    public function showUpdateForm()
    {
        $provider = ServiceProvider::find(Auth::guard('service_provider')->id());
        return view('serviceProvider.service_provider_detail_update', compact('provider'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required_if:service_provider_type,individual|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required_if:service_provider_type,individual|string|max:255',
            'business_name' => 'required_if:service_provider_type,business|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $provider = Auth::guard('service_provider')->user();

        if ($request->service_provider_type == 'individual') {
            $provider->first_name = $request->first_name;
            $provider->middle_name = $request->middle_name;
            $provider->last_name = $request->last_name;
            $provider->business_name = null;
            $provider->service_provider_type = 'individual';
        } else {
            $provider->business_name = $request->business_name;
            $provider->first_name = null;
            $provider->middle_name = null;
            $provider->last_name = null;
            $provider->service_provider_type = 'business';
        }

        $provider->email = $request->email;
        $provider->phone_number = $request->phone_number;
        
        if ($request->password) {
            $provider->password = bcrypt($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $provider->profile_picture = $profilePicturePath;
        }

        $provider = new ServiceProvider();
        $provider->save();

        return redirect()->route('service_provider.edit')->with('success', 'Profile updated successfully.');
    }
    public function delete()
    {
        $ServiceProviderid = Auth::guard('service_provider')->id();

        if ($ServiceProviderid) {
            if (ServiceProvider::destroy($ServiceProviderid)) {
                return redirect()->route('home')->with('success', 'Account deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete account.');
            }
        }

        return redirect()->back()->with('error', 'Failed to delete account.');
    }


}
