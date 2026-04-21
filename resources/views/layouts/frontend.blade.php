<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Managerial Quotient') }}</title>

        <!-- Fonts (Inter & Outfit for premium look) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#fcfdfe] selection:bg-blue-600 selection:text-white overflow-x-hidden">
        
        <!-- Global Alerts -->
        <x-ui.alerts />

        <!-- Main Header -->
        <x-frontend.header />

        <!-- Page Content -->
        <main class="relative">
            {{ $slot }}
        </main>

        <!-- Main Footer -->
        <x-frontend.footer />

        <!-- Livewire Scripts -->
        @livewireScripts
        
        <!-- Subtle background decoration -->
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-50/50 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] shadow-2xl bg-indigo-50/50 blur-[120px] rounded-full"></div>
        </div>
    </body>
</html>
