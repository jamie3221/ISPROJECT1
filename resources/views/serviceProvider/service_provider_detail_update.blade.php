<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/service_provider_detail_update.css') }}">
        <title>Update Service Provider Details</title>
    </head>
    <body>
        <a href="{{route('service_provider.dashboard')}}" class="dash-btn">Back to Dashboard</a>
        <div class="container">
            <h1>Update Service Provider Details</h1>
            
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
            
            <form action="{{ route('service_provider.update.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        @php
                            $provider = Auth::guard('service_provider')->user();
                        @endphp
                    @if ($provider->service_provider_type === 'individual')
                        <div class="form-group">
                            <label for="first_name">First Name: </label>
                            <input type="text" id="first_name" name="first_name" value="{{ Auth::guard('service_provider')->user()->first_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Middle Name: </label>
                            <input type="text" id="middle_name" name="middle_name" value="{{Auth::guard('service_provider')->user()->middle_name }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name: </label>
                            <input type="text" id="last_name" name="last_name" value="{{ Auth::guard('service_provider')->user()->last_name }}" required>
                        </div>
                    @elseif ($provider->service_provider_type === 'business')
                        <div class="form-group">
                            <label for="business_name">Business Name: </label>
                            <input type="text" id="business_name" name="business_name" value="{{ Auth::guard('service_provider')->user()->business_name }}" required>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" id="email" name="email" value="{{ Auth::guard('service_provider')->user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number: </label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ Auth::guard('service_provider')->user()->phone_number }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" value="{{Auth::guard('service_provider')->user()->password}}" required>
                    </div>
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture: </label>
                        <input type="file" id="profile_picture" name="profile_picture" value="{{Auth::guard('service_provider')->user()->profile_picture}}">
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </div>
            </form>
            <a href="{{ route('service_provider.dashboard') }}" class="btn">Back to Dashboard</a>
        </div>
    </body>
</html>