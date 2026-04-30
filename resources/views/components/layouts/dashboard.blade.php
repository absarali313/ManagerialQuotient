<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAFAFA]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MQ Elevate') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-gray-900 h-full">
    <div class="flex h-full">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-60 flex flex-col min-h-screen">
            <livewire:org.navbar />

            <main class="flex-1 p-8">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="px-8 py-4 border-t border-gray-100 flex justify-between items-center bg-white/50 backdrop-blur-sm">
                <p class="text-xs text-gray-400 font-medium">&copy; {{ date('Y') }} MQ Elevate. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-xs text-gray-400 hover:text-gray-600 font-medium">Privacy Policy</a>
                    <a href="#" class="text-xs text-gray-400 hover:text-gray-600 font-medium">Terms of Service</a>
                    <a href="#" class="text-xs text-gray-400 hover:text-gray-600 font-medium">Support</a>
                </div>
            </footer>

            <!-- Global Alerts -->
            <x-ui.alerts />
        </div>
    </div>

    @livewireScripts
</body>
</html>
