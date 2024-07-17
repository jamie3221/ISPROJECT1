<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_showreports.css') }}">
    <title>Reports</title>
</head>
<body>
    <div class="container">
        <h1>Reports</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="reports">
            <h2>Customer Reports</h2>
            @if($customerReports->isEmpty())
                <p>No customer reports available.</p>
            @else
                @foreach($customerReports as $report)
                    <div class="report">
                        <h3>{{ $report->title }}</h3>
                        <p><strong>Report Maker:</strong> {{ $report->report_maker_name }}</p>
                        <p><strong>Service in Question:</strong> {{ $report->service_name }}</p>
                        <p><strong>Message:</strong> {{ $report->message }}</p>
                    </div>
                @endforeach
            @endif

            <h2>Service Provider Reports</h2>
            @if($serviceProviderReports->isEmpty())
                <p>No service provider reports available.</p>
            @else
                @foreach($serviceProviderReports as $report)
                    <div class="report">
                        <h3>{{ $report->title }}</h3>
                        <p><strong>Report Maker:</strong> {{ $report->report_maker_name }}</p>
                        <p><strong>Service in Question:</strong> {{ $report->service_name }}</p>
                        <p><strong>Message:</strong> {{ $report->message }}</p>
                    </div>
                @endforeach
            @endif
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a>
    </div>
</body>
</html>
