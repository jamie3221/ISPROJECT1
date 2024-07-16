<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/welcome_page.css') }}">
        <title>Welcome to Housecare Connect</title>
    </head>
    <body>
        <div class="welcome-container">
            <h1>WELCOME TO HOUSECARE CONNECT</h1>
            <div class="buttons">
                <a class="btn" href="{{route('login')}}">Log In</a>
                <a class="btn" href="{{route('register')}}">Register</a>
            </div>
        </div>
        <a class="admin-login-link" href="admin.login">Admin Login</a>
    </body>
</html>