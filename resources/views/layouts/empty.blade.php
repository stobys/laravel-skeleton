<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        
    <x-layout.favicon />
    @vite()
    
    @yield('headerStyles')
    @yield('headerScripts')
</head>

<body>
    @yield('content')
</body>

</html>