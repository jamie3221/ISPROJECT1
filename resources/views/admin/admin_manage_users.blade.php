<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_manage_users.css') }}">
    <title>Manage Users</title>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @php
            use App\Models\Customer;
            use App\Models\ServiceProvider;
            $customers = Customer::all();
            $serviceProviders = ServiceProvider::all();
        @endphp

        <h2>Customers</h2>
        <div class="users">
            @if($customers->isEmpty())
                <p>No customers found.</p>
            @else
                @foreach($customers as $customer)
                    <div class="user">
                        <p>{{ $customer->name }} ({{ $customer->email }})</p>
                        <form action="{{ route('admin.banCustomer', $customer->customer_id) }}" method="POST">
                            @csrf
                            <button type="submit">Ban & Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        <h2>Service Providers</h2>
        <div class="users">
            @if($serviceProviders->isEmpty())
                <p>No service providers found.</p>
            @else
                @foreach($serviceProviders as $serviceProvider)
                    <div class="user">
                        <p>{{ $serviceProvider->name }} ({{ $serviceProvider->email }})</p>
                        <form action="{{ route('admin.banServiceProvider', $serviceProvider->service_provider_id) }}" method="POST">
                            @csrf
                            <button type="submit">Ban & Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
