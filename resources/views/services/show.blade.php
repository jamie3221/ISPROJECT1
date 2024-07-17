<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <title>Service Info</title>
</head>
<body>
    <div class="container">
        <h1>Service Details</h1>
        
        <h2>{{ $service->service_name }}</h2>
        <p>{{ $service->description }}</p>
        <p><strong>Provider:</strong> 
            @if ($service->provider->is_individual)
                {{ $service->provider->first_name }}
            @else
                {{ $service->provider->business_name }}
            @endif
        </p>

        <form action="{{ route('service.request', $service->serivce_id) }}" method="POST">
            @csrf
            <button type="submit">Request Service</button>
        </form>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>
