<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">



    <!-- Your custom CSS or additional styles -->
    <style>
        /* Add any custom styles here */
    </style>
</head>

<body>
    @include('Admin.navbar')
    <div class="row">
        <div class="col-2">
            @include('Admin.sidebar')
        </div>

        <div class="col-9">
            @yield('content')
        </div>
    </div>


    <!-- Additional scripts -->
    @include('Admin.Scripts')
</body>

</html>
