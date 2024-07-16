<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/customer_dashboard.css') }}">
        <title>Customer Dashboard</title>
    </head>
    <body>
        <div class="container">
            <h1>Customer Dashboard</h1>
            <p>Name: {{$customer->first_name}} {{$customer->last_name}}</p>
            <p>Email: {{$customer->email}}</p>
            <p>Phone Number: {{$customer->phone_number}}</p>
            <div class="actions">
                <a href="{{route('customer.account.edit')}}" class="btn btn-primaty">Update Account Details</a>
                <a href="{{route('customer.history')}}" class="btn btn-info">Chech Service history</a>
                <form action="{{route('customer.account.delete')}}" method="POST" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </body>

</html>