<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/admin_login_page.css')}}">
        <title>Admin Login</title>
    </head>
    <body>
        <div class="container">
            <div class="login-box">
                <div id="admin-login" class="login-form">
                    <h2>Admin Login</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.login.submit')}}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" class="btn">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>