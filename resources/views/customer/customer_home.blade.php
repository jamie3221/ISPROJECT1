<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <link rel="stylesheet" href="{{ asset('css/customer_home.css') }}">
    <style>
        .service-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
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
        @forelse($services as $service)
            <div class="service-box" onclick="toggleDetails('{{ $service->id }}')">
                <h3>{{ $service->service_name }}</h3>
                <p><strong>Provider:</strong> 
                    @if ($service->provider->is_individual)
                        {{ $service->provider->first_name }}
                    @else
                        {{ $service->provider->business_name }}
                    @endif
                </p>

                <div class="details" id="details{{ $service->service_id }}">
                    <p><strong>Description:</strong> {{ $service->description }}</p>
                    <form action="{{ route('service.request', $service->id) }}" method="POST">
                        @csrf
                        <button type="submit">Request Service</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No services offered.</p>
        @endforelse
    </div>

    <div class="bottom-bar">
        <p>Contact us at info@housecareconnect.com</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleDetails(serviceId) {
            $('#details' + serviceId).slideToggle();
        }
    </script>
</body>
</html>
