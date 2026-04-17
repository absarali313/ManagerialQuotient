<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Managerial Quotient') }} — Sign In</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
            .auth-gradient {
                background: linear-gradient(135deg, #3b82f6 0%, #6366f1 50%, #8b5cf6 100%);
            }
            .feature-icon { opacity: 0.85; }
        </style>
    </head>
    <body class="antialiased bg-white">
        <div class="min-h-screen flex">

            <!-- ─── Left Panel: Brand + Features ─── -->
            <div class="hidden lg:flex lg:w-[52%] auth-gradient flex-col justify-between p-14 relative overflow-hidden">
                <!-- Decorative blobs -->
                <div class="absolute top-0 left-0 w-96 h-96 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-purple-600/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
                <div class="absolute top-1/2 right-0 w-64 h-64 bg-blue-400/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-2xl"></div>

                <div class="relative z-10">
                    <!-- Logo -->
                    <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur-md border border-white/20 flex items-center justify-center mb-12 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>

                    <!-- Headline -->
                    <h1 class="text-5xl font-black text-white leading-tight tracking-tight mb-4">
                        Managerial<br>Quotient
                    </h1>
                    <p class="text-blue-100 text-base font-medium mb-12 opacity-90">AI-Powered Performance Intelligence System</p>

                    <!-- Feature list -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-4">
                            <div class="w-9 h-9 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/10 shrink-0">
                                <svg class="w-4 h-4 text-white feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <p class="text-white text-sm font-medium"><span class="font-bold">Data:</span> <span class="opacity-80">Unified performance metrics</span></p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-9 h-9 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/10 shrink-0">
                                <svg class="w-4 h-4 text-white feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <p class="text-white text-sm font-medium"><span class="font-bold">AI:</span> <span class="opacity-80">Advanced pattern recognition</span></p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-9 h-9 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/10 shrink-0">
                                <svg class="w-4 h-4 text-white feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </div>
                            <p class="text-white text-sm font-medium"><span class="font-bold">Insights:</span> <span class="opacity-80">Actionable intelligence</span></p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-9 h-9 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/10 shrink-0">
                                <svg class="w-4 h-4 text-white feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <p class="text-white text-sm font-medium"><span class="font-bold">Decisions:</span> <span class="opacity-80">Strategic performance optimization</span></p>
                        </div>
                    </div>
                </div>

                <!-- Bottom trust badges -->
                <div class="relative z-10 flex items-center gap-6">
                    <div class="flex items-center gap-2 text-white/60 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Enterprise-grade encryption
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        SOC2-ready
                    </div>
                    <div class="flex items-center gap-2 text-white/60 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Secure AI data processing
                    </div>
                </div>
            </div>

            <!-- ─── Right Panel: Auth Form ─── -->
            <div class="flex-1 flex flex-col items-center justify-center px-8 py-12 bg-white relative">
                <!-- Mobile logo (only shown on small screens) -->
                <div class="lg:hidden mb-10 text-center">
                    <div class="w-12 h-12 rounded-2xl auth-gradient flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <h2 class="text-xl font-black text-slate-900">Managerial Quotient</h2>
                </div>

                <div class="w-full max-w-sm">
                    {{ $slot }}
                </div>

                <!-- Bottom trust badges (mobile / right panel) -->
                <div class="absolute bottom-8 left-0 right-0 flex items-center justify-center gap-6 lg:flex">
                    <div class="flex items-center gap-1.5 text-slate-400 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Enterprise-grade encryption
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-400 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        SOC2-ready
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-400 text-[11px] font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Secure AI data processing
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
