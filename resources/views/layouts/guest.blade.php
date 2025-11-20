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
        <!-- Minimalist Background -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white relative">
            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0,0,0,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.05) 1px, transparent 1px); background-size: 20px 20px;"></div>
            </div>

            <!-- Logo Section -->
            <div class="relative z-10 mb-8">
                <a href="/" class="block group">
                    <div class="relative">
                        <!-- Logo with minimalist styling -->
                        <div class="bg-black p-4 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105 flex items-center justify-center">
                            <x-application-logo class="w-16 h-16 filter brightness-0 invert" />
                        </div>
                        
                        <!-- Brand Name -->
                        <div class="text-center mt-4">
                            <h1 class="text-3xl font-roboto-flex font-bold text-black tracking-wider">
                                BAD<span class="text-gray-600">GUYS</span>
                            </h1>
                            <div class="h-1 w-20 bg-black mx-auto mt-2 rounded-full"></div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Auth Form Container -->
            <div class="w-full sm:max-w-md relative z-10">
                <div class="bg-white shadow-xl overflow-hidden rounded-2xl border border-gray-200 relative">
                    <!-- Simple top border -->
                    <div class="h-1 bg-black"></div>
                    
                    <!-- Form Content -->
                    <div class="px-8 py-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            
            <!-- Footer Text -->
            <div class="mt-8 text-center relative z-10">
                <p class="text-gray-600 text-sm font-montserrat">
                    © 2024 BIGI.NYC. Estilo que marca la diferencia.
                </p>
            </div>
        </div>
    </body>
</html>
