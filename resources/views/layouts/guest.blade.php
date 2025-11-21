<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BIGI.NYC') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <!-- BIGI.NYC Custom Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Fruktur:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik+Wet+Paint&display=swap" rel="stylesheet">

        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
       
    </head>
    <body class="font-montserrat text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-white">
            <div class="w-full sm:max-w-sm px-6">
                <div class="mb-6 text-center">
                    <a href="/" class="inline-flex items-center gap-3">
                        <x-application-logo class="w-10 h-10" />
                        <span class="text-xl font-semibold text-black">BIGI.NYC</span>
                    </a>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    {{ $slot }}
                </div>

                <div class="mt-6 text-center">
                    <p class="text-gray-400 text-xs">© 2024 BIGI.NYC</p>
                </div>
            </div>
        </div>
    </body>
</html>
