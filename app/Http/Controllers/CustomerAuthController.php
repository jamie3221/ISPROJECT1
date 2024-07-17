<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\ServiceRequest;
use App\Models\BlacklistedCustomer;
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

        if (BlacklistedCustomer::where('email', $request->email)->exists()
            || BlacklistedCustomer::where('phone_number', $request->phone_number)->exists()) {
            return redirect()->back()->with('error', 'You are blacklisted from using our services.');
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
        
        return view('/customer/customer_dashboard', compact('customer'));
    }
    public function delete()
    {
        $customerId = Auth::guard('customer')->id();

        if ($customerId) {
            if (Customer::destroy($customerId)) {
                return redirect()->route('home')->with('success', 'Account deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete account.');
            }
        }

        return redirect()->back()->with('error', 'Failed to delete account.');
    }
    public function showServiceHistory()
    {
        $customerId = Auth::guard('customer')->id(); // Get current customer's ID
        $serviceRequests = ServiceRequest::where('customer_id', $customerId)
                            ->with('service') // Eager load related service
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('customer.customer_service_history', compact('serviceRequests'));
    }
    public function createServiceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required|exists:service_providers,service_provider_id',
            'service_id' => 'required|exists:services,service_id',
            'status' => 'required|in:pending,accepted,in_progress,completed,cancelled',
            'scheduled_date' => 'nullable|date',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $customer = Auth::guard('customer')->user();

        $serviceRequest = new ServiceRequest();
        $serviceRequest->customer_id = $customer->customer_id;
        $serviceRequest->service_provider_id = $request->service_provider_id;
        $serviceRequest->service_id = $request->service_id;
        $serviceRequest->status = $request->status;
        $serviceRequest->scheduled_date = $request->scheduled_date;
        // Add other fields as needed
        $serviceRequest->save();

        return response()->json(['message' => 'Service request created successfully', 'data' => $serviceRequest], 201);
    }

    /**
     * Update an existing service request.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateServiceRequest(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::find($id);

        if (!$serviceRequest) {
            return response()->json(['error' => 'Service request not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,accepted,in_progress,completed,cancelled',
            'scheduled_date' => 'nullable|date',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $serviceRequest->status = $request->status;
        $serviceRequest->scheduled_date = $request->scheduled_date;
        // Update other fields as needed
        $serviceRequest->save();

        return response()->json(['message' => 'Service request updated successfully', 'data' => $serviceRequest], 200);
    }

    /**
     * Delete an existing service request.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteServiceRequest($id)
    {
        $serviceRequest = ServiceRequest::find($id);

        if (!$serviceRequest) {
            return response()->json(['error' => 'Service request not found'], 404);
        }

        $serviceRequest->delete();

        return response()->json(['message' => 'Service request deleted successfully'], 200);
    }

}