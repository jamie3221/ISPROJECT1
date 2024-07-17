<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_manage_admins.css') }}">
    <title>Admin Management</title>
</head>
<body>
    <div class="container">
        <h1>Admin Management</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Add Admin</h2>
        <form action="{{ route('admin.add') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Add Admin</button>
        </form>

        <h2>Current Admins</h2>
        @php
            use App\Models\SystemAdministrator;
            $system_administrator = SystemAdministrator::all();
        @endphp
        @if($system_administrator->isEmpty())
            <p>No admins found.</p>
        @else
            <ul>
                @foreach($system_administrator as $admin)
                    <li>
                        {{ $admin->name }} ({{ $admin->email }})
                        <form action="{{ route('admin.remove', $admin->admin_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
