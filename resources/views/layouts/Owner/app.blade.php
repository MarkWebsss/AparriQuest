<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Capstone') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="{{asset('build/bootstrap/bootstrap.v5.3.2.min.css')}}">

    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <div class="flex-1">
                @include('layouts.Owner.navigation')
                    
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
