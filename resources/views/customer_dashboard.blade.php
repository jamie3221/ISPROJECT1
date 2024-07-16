<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/customer_dashboard.css') }}">
    <title>Customer Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Customer Dashboard</h1>
        
        @if(isset($customer))
            @if($customer->profile_picture)
                <img src="{{ asset($customer->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            @else
                <!-- Default profile picture or placeholder -->
                <img src="{{ asset('images/default_profile_picture.png') }}" alt="Default Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            @endif
            
            <p>Name: {{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }}</p>
            <p>Email: {{ $customer->email }}</p>
            <p>Phone Number: {{ $customer->phone_number }}</p>
            
            <div class="actions">
                <a href="#" class="btn btn-primary">Update Account Details</a>
                <a href="#" class="btn btn-info">Check Service History</a>
                
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
