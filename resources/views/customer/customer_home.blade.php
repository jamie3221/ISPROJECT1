<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <link rel="stylesheet" href="{{ asset('css/customer_home.css') }}">
</head>
<body>
    <div class="top-bar">
        <a href="{{ route('customer.dashboard') }}">Dashboard</a>
        <form id="logoutForm" action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="welcome-message">
        Hello, {{ Auth::guard('customer')->user()->first_name }}
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search for services...">
    </div>

    <div class="content-box">
        <h2>Requested Services</h2>
        <ul>
            @forelse(Auth::guard('customer')->user()->serviceRequests as $request)
                <li>{{ $request->service->service_name }}</li>
            @empty
                <li>No requested services.</li>
            @endforelse
        </ul>
    </div>

    <div class="services-box">
        <h2>Services Offered</h2>
        @php
            use App\Models\Service;
            $services = Service::all();
        @endphp
        <div class="services-grid">
            @forelse($services as $service)
                <div class="service-item">
                    <a href="{{ route('service.info', $service->id) }}">{{ $service->service_name }}</a>
                </div>
            @empty
                <p>No services offered.</p>
            @endforelse
        </div>
    </div>

    <div class="bottom-bar">
        <p>Contact us at info@housecareconnect.com</p>
    </div>
</body>
</html>
