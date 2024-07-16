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
        <a href="{{route('customer.dashboard')}}">Dashboard</a>
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
        <!-- List of requested services goes here -->
        <ul>
            <!-- Example item -->
            <li>Service Request 1</li>
            <li>Service Request 2</li>
            <li>Service Request 3</li>
        </ul>
    </div>

    <div class="services-box">
        <h2>Services Offered</h2>
        <div class="services-grid">
            <!-- Example items -->
            <div class="service-item">Service 1</div>
            <div class="service-item">Service 2</div>
            <div class="service-item">Service 3</div>
            <div class="service-item">Service 4</div>
            <div class="service-item">Service 5</div>
            <div class="service-item">Service 6</div>
            <div class="service-item">Service 7</div>
            <div class="service-item">Service 8</div>
            <div class="service-item">Service 9</div>
        </div>
    </div>

    <div class="bottom-bar">
        <p>Contact us at info@housecareconnect.com</p>
    </div>
</body>
</html>
