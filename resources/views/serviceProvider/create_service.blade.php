<!-- create_service.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/service_provider_create_service.css') }}">
    <title>Create Service</title>
</head>
<body>
    <div class="container">
        <h1>Create Service</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('service.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" id="service_name" name="service_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="location_id">Location</label>
                <select id="location_id" name="location_id" required>
                    <option value="">Select Location</option>
                    @php
                        use App\Models\Location;
                        $locations = Location::all();
                    @endphp
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="pictures">Pictures</label>
                <input type="file" id="pictures" name="pictures[]" multiple accept="image/*">
                <small>Upload one or more pictures for this service (JPEG, PNG, GIF, or BMP).</small>
            </div>

            <button type="submit" class="submit-btn">Create Service</button>
        </form>

        <a href="{{ route('service_provider.home') }}" class="btn">home</a>
    </div>
</body>
</html>
