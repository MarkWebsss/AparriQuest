<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-center flex justify-center items-center" 
            style="
            background-image: url('{{ asset('aparriquest/aparri.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;">
            {{--
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            --}}
            <div class="container w-full sm:max-w-md mt-6 px-6 py-4 d-flex justify-content-center align-items-center">
             <div class="card glass-card p-4">
                {{ $slot }}
            </div>
            <style>
                .glass-card {
                    background-color: rgba(255, 255, 255, 0.2);
                    border-radius: 15px;
                    backdrop-filter: blur(10px);
                    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.2); 
                }
            </style>
        </div>
    </body>
</html>
