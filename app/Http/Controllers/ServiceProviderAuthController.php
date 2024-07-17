<?php
namespace App\Http\Controllers;

use App\Models\BlacklistedServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\ServiceProvider;
use App\Models\ServiceRequest;
use App\Models\Service;
use App\Models\Location; // Add this line to import the Location class
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

    if (BlacklistedServiceProvider::where('email', $request->email)->exists()
    || BlacklistedServiceProvider::where('phone_number', $request->phone_number)->exists()) {
    return redirect()->back()->with('error', 'You are blacklisted from using our services.');
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
    public function createService(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Create new service listing
        $service = new Service();
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->service_provider_id = auth::guard('service_provider')->user()->id;
        
        // Save the service
        $service->save();

        // Redirect with success message or to a confirmation page
        return redirect()->back()->with('success', 'Service listed successfully.');
    }
    public function create()
    {
        // Retrieve locations from the database
        $locations = Location::all();

        return view('service.create_service', compact('locations'));
    }

    // Method to store the created service in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'required|string',
            'location_id' => 'required|exists:locations,id',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate each picture
        ]);

        // Handle picture uploads
        $picturePaths = [];
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $path = $picture->store('service_pictures', 'public'); // Store picture in storage/app/public/service_pictures
                $picturePaths[] = $path;
            }
        }

        // Create service record in the database
        $service = new Service();
        $service->service_name = $validatedData['service_name'];
        $service->description = $validatedData['description'];
        $service->location_id = $validatedData['location_id'];
        $service->service_provider_id = Auth::guard('service_provider')->user()->location_id;
        $service->save();

        // Redirect back with success message
        return redirect()->route('service.dashboard')->with('success', 'Service listing created successfully.');
    }
    public function show($location_id)
    {
        $service = Service::findOrFail($location_id);

        return view('services.show', compact('service'));
    }
}
