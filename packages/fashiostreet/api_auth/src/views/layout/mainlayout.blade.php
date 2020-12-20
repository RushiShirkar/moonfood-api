<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#263238">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#263238">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#263238">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/fashiostreet-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loginsystem.css') }}">
    <script>
        var token = localStorage.getItem('token');
        var local_id = localStorage.getItem('local_id');
        if(token != null || local_id != null)
        {
            window.location.href = '/';
        }
    </script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom_validation.js') }}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-3" >
        </div>
        <div class="col-sm-4 primary-color form-card col-sm-offset-1">
            @yield('content')
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div>
<div class="loading">
    <div class="linePreloader"></div>
</div>
</body>
</html>