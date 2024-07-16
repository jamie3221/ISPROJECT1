<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/customer_dashboard.css') }}">
    <title>Customer Dashboard</title>
</head>
<body>
<a href="{{route('customer.home')}}" class="home-btn">Back to Home</a>
    <div class="container">
        <h1>Customer Dashboard</h1>
        
        @php
        $customerGuard = Auth::guard('customer');
        @endphp
        
        @if(isset($customerGuard))
            @if($customer->profile_picture)
                <img src="{{ asset({{ Auth::guard('customer')->user()->profile_picture }}) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            @else
               
                <img src="{{ asset('images\profile pictures\Default-Profile-Picture-Transparent-Image.png') }}" alt="Default Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            @endif
            
            <p>Name: {{ Auth::guard('customer')->user()->first_name }} {{ Auth::guard('customer')->user()->middle_name }} {{ Auth::guard('customer')->user()->last_name }}</p>
            <p>Email: {{ Auth::guard('customer')->user()->email }}</p>
            <p>Phone Number: {{ Auth::guard('customer')->user()->phone_number }}</p>
            
            <div class="actions">
                <a href="{{route ('customer.update')}}" class="btn btn-primary">Update Account Details</a>
                <a href="{{route ('customer.history')}}" class="btn btn-info">Check Service History</a>
                
                <form action="#" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Account</button>
                </form>
            </div>
        @else
            <p>No customer data available.</p>
        @endif
    </div>

    <!-- Include any scripts or additional content here -->
</body>
</html>
