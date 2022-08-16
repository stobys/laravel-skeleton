<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        
    <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">

    @vite()
    
    @yield('headerStyles')
    @yield('headerScripts')
</head>

<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>