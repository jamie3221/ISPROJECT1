<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/register_page.css')}}">
        <title>Register - Housecare Connect</title>
    </head>
    <body>
        <div class = "container">
            <div class = "register-box">
                <div class="register-switch">
                    <button class="switch-btn active" data-type="customer"> Register as a customer</button>
                    <button class="switch-btn" data-type="service_provider"> Register as a service provider</button>
                </div>
                <div id="customer-register" class="register-form active">
                    <h2>Customer Registration</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="first_name" placeholder="First Name" required>
                        <input type="text" name="middle_name" placeholder="Middle Name">
                        <input type="text" name="last_name" placeholder="Last Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="number" name="phone_number" placeholder="Phone Number" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(event)">
                        <img id="profile_preview" src="{{ asset('images\profile pictures\Default-Profile-Picture-Transparent-Image.png') }}" alt="Profile Picture" class="profile-preview">
                        <button type="submit" class="btn">Register</button>
                    </form>	
                </div>
                <div id="service-provider-register" class="register-form">
                    <h2>Service Provider Registration</h2>
                    <div class="service-provider-type-switch">
                        <button class="service-provider-type-btn active" data-type="individual"> Individual</button>
                        <button class="service-provider-type-btn" data-type="company"> Company</button>
                    </div>
                    <div id="individual-register" class="register-form active">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="first_name" placeholder="First Name" required>
                            <input type="text" name="middle_name" placeholder="Middle Name">
                            <input type="text" name="last_name" placeholder="Last Name" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="number" name="phone_number" placeholder="Phone Number" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(event)">
                            <img id="profile_preview" src="{{ asset('images\profile pictures\Default-Profile-Picture-Transparent-Image.png') }}" alt="Profile Picture" class="profile-preview">
                            <button type="submit" class="btn">Register</button>
                        </form>
                    </div>
                    <div id="business-register" class="register-form">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="company_name" placeholder="Company Name" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="number" name="phone_number" placeholder="Phone Number" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewImage(event)">
                            <img id="profile_preview" src="{{ asset('images\profile pictures\Default-Profile-Picture-Transparent-Image.png') }}" alt="Profile Picture" class="profile-preview">
                            <button type="submit" class="btn">Register</button>
                        </form>
                    </div>
                </div>
                <div class="register-options">
                    <p>Already have an account? <a href="{{route('login')}}">Log in</a></p>	
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                const switchBtns = document.querySelectorAll('.switch-btn');
                const customerRegister = document.getElementById('customer-register');
                const serviceProviderRegister = document.getElementById('service-provider-register');
                switchBtns.forEach(btn =>{
                    btn.addEventListener('click', function(){
                        switchBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        if(this.getAttribute('data-type') === 'customer'){
                            customerRegister.classList.add('active');
                            serviceProviderRegister.classList.remove('active');
                        }else{
                            serviceProviderRegister.classList.add('active');
                            customerRegister.classList.remove('active');
                        }
                    });
                });
                const serviceProviderTypeBtns = document.querySelectorAll('.service-provider-type-btn');
                const individualRegister = document.getElementById('individual-register');
                const businessRegister = document.getElementById('business-register');
                serviceProviderTypeBtns.forEach(btn =>{
                    btn.addEventListener('click', function(){
                        serviceProviderTypeBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        if(this.getAttribute('data-type') === 'individual'){
                            individualRegister.classList.add('active');
                            businessRegister.classList.remove('active');
                        }else{
                            businessRegister.classList.add('active');
                            individualRegister.classList.remove('active');
                        }
                    });
                });
            });
        </script>
    </body>
</html>