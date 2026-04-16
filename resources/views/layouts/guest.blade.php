<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MQ') }} | Access Protocol</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-zinc-950 text-white overflow-hidden selection:bg-indigo-500 selection:text-white">
        <!-- Persistent Background -->
        <div class="fixed inset-0 z-0">
            <div class="absolute top-0 -left-1/4 w-[1000px] h-[1000px] bg-indigo-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 -right-1/4 w-[800px] h-[800px] bg-purple-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 contrast-150 brightness-150"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 px-4">
            <div class="mb-8">
                <a href="/" wire:navigate class="flex flex-col items-center gap-4 group">
                    <div class="w-16 h-16 bg-indigo-600 rounded-[2rem] flex items-center justify-center font-black italic text-3xl shadow-[0_0_40px_rgba(79,70,229,0.4)] group-hover:scale-105 transition-transform duration-500">MQ</div>
                    <span class="text-xs font-black italic tracking-[0.4em] uppercase text-zinc-500 group-hover:text-white transition-colors">Neural Terminal</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 p-8 glass-card !border-white/10 !bg-zinc-900/40 backdrop-blur-3xl shadow-2xl overflow-hidden relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
            
            <div class="mt-8">
                 <p class="text-[9px] font-black text-zinc-600 uppercase tracking-widest italic">Encrypted Connection Established // Protocol V4.2</p>
            </div>
        </div>
    </body>
</html>
