<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MQ') }} | Intelligence System</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>body { font-family: 'Outfit', sans-serif; }</style>
    </head>
    <body class="h-full bg-zinc-950 antialiased custom-scrollbar text-white overflow-hidden">
        <!-- Background Elements -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-indigo-600/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-purple-600/5 rounded-full blur-[120px]"></div>
        </div>

        <div class="flex h-full overflow-hidden relative z-10">
            <!-- Sidebar -->
            <aside class="hidden lg:flex flex-col w-72 bg-zinc-900/50 backdrop-blur-2xl border-r border-white/5">
                <div class="flex items-center h-24 px-8 border-b border-white/5">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center font-black italic text-xl shadow-[0_0_20px_rgba(79,70,229,0.3)]">MQ</div>
                        <span class="text-xs font-black italic tracking-[0.4em] uppercase text-zinc-500 group-hover:text-white transition-colors">Neural Hub</span>
                    </a>
                </div>
                
                <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar">
                    <div class="px-4 mb-4 text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600">Primary Core</div>
                    <a href="{{ route('dashboard') }}" class="mq-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Analytics
                    </a>
                    <a href="{{ route('assessment') }}" class="mq-sidebar-link {{ request()->routeIs('assessment') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Evaluations
                    </a>
                    
                    <div class="pt-8 px-4 mb-4 text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600">Personnel</div>
                    <a href="{{ url('/hub') }}" class="mq-sidebar-link {{ request()->path() === 'hub' ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Growth Hub
                    </a>
                    <a href="{{ url('/cycles') }}" class="mq-sidebar-link {{ request()->path() === 'cycles' ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Cycles
                    </a>
                    <a href="{{ url('/goals') }}" class="mq-sidebar-link {{ request()->path() === 'goals' ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Objectives
                    </a>

                    <div class="pt-auto mt-auto border-t border-white/5 p-4">
                        <a href="{{ route('profile') }}" class="mq-sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Settings
                        </a>
                    </div>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                <!-- Top Header -->
                <header class="h-24 bg-zinc-900/10 backdrop-blur-3xl border-b border-white/5 flex items-center justify-between px-10 shrink-0">
                    <div class="flex flex-1 max-w-xl">
                        <div class="relative w-full group">
                            <input type="text" placeholder="Access Neural Threads..." class="w-full bg-white/5 border border-white/5 rounded-2xl py-3 pl-12 focus:ring-4 focus:ring-indigo-500/10 transition-all text-[10px] font-black uppercase tracking-widest placeholder-zinc-600">
                            <svg class="w-4 h-4 absolute left-5 top-3.5 text-zinc-600 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-8 ml-8">
                        <button class="relative text-zinc-500 hover:text-white transition-all transform hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-indigo-500 rounded-full border-2 border-zinc-950"></span>
                        </button>
                        <div class="flex items-center gap-5 pl-8 border-l border-white/5">
                             <div class="text-right hidden sm:block">
                                <p class="text-xs font-black text-zinc-100 italic tracking-tighter">{{ Auth::user()->name }}</p>
                                <p class="text-[9px] font-black text-zinc-600 uppercase tracking-widest mt-0.5">Neural Admin</p>
                             </div>
                             <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-indigo-600 p-0.5 shadow-lg shadow-indigo-500/10 hover:scale-105 transition-transform cursor-pointer">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=fff&background=6366f1" class="w-full h-full rounded-2xl border-2 border-zinc-900" alt="Avatar">
                             </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-10 bg-transparent custom-scrollbar">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
