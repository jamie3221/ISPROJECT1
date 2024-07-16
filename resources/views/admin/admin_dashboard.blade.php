<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Reports</h2>
        <div class="reports">
            @foreach($reports as $report)
                <div class="report">
                    <h3>{{ $report->title }}</h3>
                    <p>{{ $report->description }}</p>
                </div>
            @endforeach
        </div>

        <h2>Manage Users</h2>
        <div class="users">
            @foreach($users as $user)
                <div class="user">
                    <p>{{ $user->name }} ({{ $user->email }})</p>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <h2>Manage Admins</h2>
        <div class="admins">
            @foreach($admins as $admin)
                <div class="admin">
                    <p>{{ $admin->name }} ({{ $admin->email }})</p>
                    <form action="{{ route('admin.admins.delete', $admin->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <h2>Create New Admin</h2>
        <form action="{{ route('admin.admins.create') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">Create Admin</button>
        </form>
    </div>
</body>
</html>
