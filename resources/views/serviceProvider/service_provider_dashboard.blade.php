<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/service_provider_dashboard.css') }}">
    <title>Service Provider Dashboard</title>
</head>
<body>
<a href="{{ route('service_provider.home') }}" class="home-btn">Back to Home</a>
    <div class="container">
        <h1>Service Provider Dashboard</h1>
        
        @php
        $providerGuard = Auth::guard('service_provider');
        @endphp
        
        @if(isset($providerGuard))
            @if(Auth::guard('service_provider')->user()->profile_picture)
                <img src="{{ asset(Auth::guard('service_provider')->user()->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            @else
                <img src="{{ asset('images/profile_pictures/Default-Profile-Picture.png') }}" alt="Default Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            @endif
            
            <p>Name: {{ Auth::guard('service_provider')->user()->business_name ?: Auth::guard('service_provider')->user()->first_name }}</p>
            <p>Email: {{ Auth::guard('service_provider')->user()->email }}</p>
            <p>Phone Number: {{ Auth::guard('service_provider')->user()->phone_number }}</p>
            
            <div class="actions">
                <a href="{{route ('service_provider.update')}}" class="btn btn-primary">Update Account Details</a>
                <a href="{{route ('service_provider.history')}}" class="btn btn-info">Check Service History</a>
                
                <form action="{{route('service_provider.delete')}}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Account</button>
                </form>
            </div>
        @else
            <p>No service provider data available.</p>
        @endif
    </div>

    <!-- Include any scripts or additional content here -->
</body>
</html>
