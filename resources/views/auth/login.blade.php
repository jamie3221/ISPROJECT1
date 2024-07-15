<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/login_page.css')}}">
        <title>Login - Housecare Connect</title>
    </head>
    <body></body>
        <div class = "container">
            <div class = "login-box">
                <div class="login-switch">
                    <button class="switch-btn active" data-type="customer"> Log in as a customer</button>
                    <button class="switch-btn" data-type="service_provider"> Log in as a service provider</button>
                </div>
                <div id="customer-login" class="login-form active">
                    <h2>Customer Login</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('login.post')}}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" class="btn">Log In</button>
                    </form>
                </div>
                <div id="service-provider-login" class="login-form">
                    <h2>Service Provider Login</h2>
                    <form action="" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" class="btn">Log In</button>
                    </form>
                </div>
                <div class="login-options">
                    <a href="#">Forgot Password?</a>
                    <p>Don't have an account? <a href="{{route('register')}}">Register for free!</a></p>    
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                const switchBtns = document.querySelectorAll('.switch-btn');
                const customerLogin = document.getElementById('customer-login');
                const serviceProviderLogin = document.getElementById('service-provider-login');
                switchBtns.forEach(btn =>{
                    btn.addEventListener('click', function(){
                        switchBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        if(this.getAttribute('data-type') === 'customer'){
                            customerLogin.classList.add('active');
                            serviceProviderLogin.classList.remove('active');
                    }else{
                        serviceProviderLogin.classList.add('active');
                        customerLogin.classList.remove('active');
                    }
                });
                });
            });
        </script>

    </body>
</html>