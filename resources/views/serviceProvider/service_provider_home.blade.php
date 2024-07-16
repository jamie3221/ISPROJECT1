<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/service_provider_home.css') }}">
    <title>Service Provider Home</title>
</head>
<body>
    <div class="top-bar">
        <a href="{{route ('service_provider.dashboard')}}">Dashboard</a>
        <form action="{{route ('service_provider.logout')}}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
    
    <div class="container">
        <h1>Hello,
            @if(Auth::guard('service_provider')->user()->business_name)
                {{ Auth::guard('service_provider')->user()->business_name }}
            @else
                {{ Auth::guard('service_provider')->user()->first_name }}
            @endif
        </h1>

        <div class="content-box">
            <h2>Applications by Customers</h2>
            @if(Auth::guard('service_provider')->user()->serviceRequests()->count() > 0)
                @foreach(Auth::guard('service_provider')->user()->serviceRequests()->orderBy('created_at', 'desc')->get() as $request)
                    <div class="service-request">
                        <p>Customer: {{ $request->customer->first_name }} {{ $request->customer->last_name }}</p>
                        <p>Status: {{ $request->status }}</p>
                        <p>Requested On: {{ $request->created_at->format('M d, Y') }}</p>
                    </div>
                @endforeach
            @else
                <p>No applications found.</p>
            @endif
        </div>

        <div class="content-box">
            <h2>Services Offered</h2>
            <div class="service-grid">
                @if(Auth::guard('service_provider')->user()->services()->count() > 0)
                    @foreach(Auth::guard('service_provider')->user()->services()->orderBy('created_at', 'desc')->get() as $service)
                        <div class="service-item">
                            <h3>{{ $service->name }}</h3>
                            <p>{{ $service->description }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No services found.</p>
                @endif
            </div>
            <a href="#" class="btn btn-primary">Create Service Posting</a>
        </div>
    </div>

    <div class="bottom-bar">
        <p>Contact Info: support@example.com</p>
    </div>
</body>
</html>
