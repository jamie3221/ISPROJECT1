<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
    <title>Admin Dashboard</title>
</head>
<body>
<form id="logoutForm" action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <div class="container">
        <h1>Admin Dashboard</h1>

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

        <div class="content-box">
            <h2>Reports</h2>
            <a href="{{route('admin.reports')}}" class="btn">View Reports</a>
        </div>

        <div class="content-box">
            <h2>Manage Users</h2>
            <a href="{{route('admin.manageUsers')}}" class="btn">Manage Users</a>
        </div>

        <div class="content-box">
            <h2>Manage Admins</h2>
            <a href="{{route('admin.manage')}}" class="btn">Manage Admins</a>
        </div>
    </div>
</body>
</html>
