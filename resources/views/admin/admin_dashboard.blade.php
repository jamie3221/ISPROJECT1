<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
    <title>Admin Dashboard</title>
</head>
<body>
    <a href="#" class="dash-btn">Logout</a>
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
            <a href="#}" class="btn">Manage Users</a>
        </div>

        <div class="content-box">
            <h2>Manage Admins</h2>
            <a href="#" class="btn">Manage Admins</a>
        </div>
    </div>
</body>
</html>
