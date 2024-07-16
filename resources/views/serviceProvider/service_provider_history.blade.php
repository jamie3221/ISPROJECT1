<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/service_provider_history.css') }}">
    <title>Service Provider Service History</title>
</head>
<body>
    <a href="{{ route('service_provider.dashboard') }}" class="dash-btn">Back to Dashboard</a>
    <div class="container">
        <h1>Service Provider Service History</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="history-list">
            @auth('service_provider')
                @php
                    $provider = Auth::guard('service_provider')->user();
                    $serviceRequests = $provider->serviceRequests()->with('customer')->orderBy('created_at', 'desc')->get();
                @endphp

                @if($serviceRequests->count() > 0)
                    @foreach($serviceRequests as $request)
                        <div class="service-request">
                            <h2>{{ $request->customer->first_name }}'s Request</h2>
                            <p>Service: {{ $request->service->name }}</p>
                            <p>Status: {{ $request->status }}</p>
                            <p>Requested On: {{ $request->created_at->format('M d, Y') }}</p>
                            <!-- Add more details as needed -->
                        </div>
                    @endforeach
                @else
                    <p>No service history found.</p>
                @endif
            @else
                <p>Please <a href="{{ route('service_provider.login') }}">log in</a> to view your service history.</p>
            @endauth
        </div>

        <a href="{{ route('service_provider.dashboard') }}">Back to Dashboard</a>
    </div>

    <!-- Include any scripts or additional content here -->
</body>
</html>
