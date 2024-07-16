<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/customer_history.css') }}">
    <title>Service History</title>
</head>
<body>
    <div class="container">
        <h1>Service History</h1>
        
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
            @auth('customer')
                @php
                    $customer = Auth::guard('customer')->user();
                    $serviceRequests = $customer->serviceRequests()->with('service')->orderBy('created_at', 'desc')->get();
                @endphp

                @if($serviceRequests->count() > 0)
                    @foreach($serviceRequests as $request)
                        <div class="service-request">
                            <h2>{{ $request->service->name }}</h2>
                            <p>Status: {{ $request->status }}</p>
                            <p>Requested On: {{ $request->created_at->format('M d, Y') }}</p>
                            <!-- Add more details as needed -->
                        </div>
                    @endforeach
                @else
                    <p>No service history found.</p>
                @endif
            @else
                <p>Please <a href="{{ route('customer.login') }}">log in</a> to view your service history.</p>
            @endauth
        </div>

        <a href="{{ route('customer.dashboard') }}">Back to Dashboard</a>
    </div>

    <!-- Include any scripts or additional content here -->
</body>
</html>
