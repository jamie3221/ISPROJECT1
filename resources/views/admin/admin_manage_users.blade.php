<!DOCTYPE HTML>
<html>
    <head>
        <title>Manage Users</title>
        <link rel="stylesheet" href="{{ asset('css/admin_manage_users.css') }}">
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
            $customers = Auth::user()->customers()->get();
            $serviceProviders = Auth::user()->serviceProviders()->get();
        @endphp

        <h2>Customers</h2>
        <div class="users">
            @foreach($customers as $customer)
                <div class="user">
                    <p>{{ $customer->name }} ({{ $customer->email }})</p>
                    <form action="{{ route('admin.banCustomer', $customer->id) }}" method="POST">
                        @csrf
                        <button type="submit">Ban & Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <h2>Service Providers</h2>
        <div class="users">
            @foreach($serviceProviders as $serviceProvider)
                <div class="user">
                    <p>{{ $serviceProvider->name }} ({{ $serviceProvider->email }})</p>
                    <form action="{{ route('admin.banServiceProvider', $serviceProvider->id) }}" method="POST">
                        @csrf
                        <button type="submit">Ban & Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a>
    </div>
    </body>
</html>