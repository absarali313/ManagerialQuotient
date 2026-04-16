<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MQ | Neural Performance Intelligence</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .text-outline {
                -webkit-text-stroke: 1px rgba(255,255,255,0.3);
                color: transparent;
            }
            .hero-mask {
                mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(2deg); }
            }
            .animate-float { animation: float 6s ease-in-out infinite; }
        </style>
    </head>
    <body class="antialiased bg-zinc-950 text-white overflow-x-hidden selection:bg-indigo-500 selection:text-white">
        <!-- Persistent Background -->
        <div class="fixed inset-0 z-0">
            <div class="absolute top-0 -left-1/4 w-[1000px] h-[1000px] bg-indigo-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 -right-1/4 w-[800px] h-[800px] bg-purple-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 contrast-150 brightness-150"></div>
        </div>

        <!-- Navigation -->
        <nav class="fixed w-full z-50 top-0 transition-all duration-500 bg-zinc-950/20 backdrop-blur-2xl border-b border-white/5">
            <div class="max-w-7xl mx-auto px-8 h-24 flex items-center justify-between">
                <div class="flex items-center gap-16">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center font-black italic text-xl shadow-[0_0_20px_rgba(79,70,229,0.4)] group-hover:scale-110 transition-transform">MQ</div>
                        <span class="text-xl font-black italic tracking-tighter uppercase">Intelligence</span>
                    </a>
                    <div class="hidden lg:flex items-center gap-10">
                        <a href="#features" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition-colors">Framework</a>
                        <a href="#ai" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition-colors">Neural Engine</a>
                        <a href="#reports" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition-colors">Analytics</a>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="mq-button-primary !py-3 !px-8 !text-[10px] uppercase tracking-widest">Command Center</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition-colors">Access Logic</a>
                        <a href="{{ route('register') }}" class="mq-button-primary !py-3 !px-8 !text-[10px] uppercase tracking-widest">Initialize</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen pt-48 pb-32 px-8 flex flex-col justify-center items-center text-center overflow-hidden z-10">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-7xl aspect-square bg-indigo-600/5 rounded-full blur-[150px]"></div>
            
            <div class="relative z-10 space-y-12 max-w-5xl mx-auto">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm animate-float">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-ping"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300">Neural V4 Engine Live</span>
                </div>

                <h1 class="text-7xl lg:text-[120px] font-black leading-[0.9] tracking-tighter italic">
                    MEASURE.<br/>
                    <span class="text-gradient">RANK.</span><br/>
                    <span class="text-outline">IMPROVE.</span>
                </h1>

                <p class="text-lg lg:text-2xl text-zinc-400 max-w-2xl mx-auto font-medium leading-relaxed italic">
                    Performance intelligence isn't a snapshot. It's a <span class="text-white font-bold">continuous autonomous stream</span> of behavioral data.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-6 pt-8">
                    <a href="{{ route('register') }}" class="mq-button-primary !py-5 !px-12 !text-xs uppercase tracking-[0.3em] shadow-[0_20px_40px_rgba(79,70,229,0.2)]">
                        Deploy Organization
                    </a>
                    <button class="px-12 py-5 bg-white/5 border border-white/10 rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:bg-white/10 transition-all flex items-center justify-center gap-3">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        System Protocol
                    </button>
                </div>
            </div>

            <!-- Dashboard Teaser -->
            <div class="mt-32 w-full max-w-6xl mx-auto relative group">
                <div class="absolute inset-0 bg-indigo-600/20 blur-[100px] group-hover:bg-indigo-600/30 transition-all"></div>
                <div class="relative border border-white/10 rounded-[40px] p-4 bg-zinc-950/80 backdrop-blur-3xl shadow-2xl">
                    <div class="flex items-center gap-2 mb-4 px-6">
                        <div class="w-3 h-3 rounded-full bg-rose-500/50"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500/50"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500/50"></div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1551288049-bbbda536ad0a?w=1600&q=80" class="w-full rounded-[28px] opacity-80 group-hover:opacity-100 transition-opacity grayscale-[0.8] group-hover:grayscale-0 duration-700" alt="Platform Intelligence Preview">
                </div>
            </div>
        </section>

        <!-- Stats Counter -->
        <section class="py-24 z-10 relative">
            <div class="max-w-7xl mx-auto px-8 grid grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach([
                    ['label' => 'Evaluation Cycles', 'value' => '94.2k', 'symbol' => '+'],
                    ['label' => 'Neural Data Points', 'value' => '1.4b', 'symbol' => ''],
                    ['label' => 'Accuracy Index', 'value' => '99.8', 'symbol' => '%'],
                    ['label' => 'Enterprise Units', 'value' => '400', 'symbol' => '+'],
                ] as $stat)
                <div class="text-center space-y-2">
                    <h4 class="text-4xl lg:text-6xl font-black text-white italic tracking-tighter">{{ $stat['value'] }}{{ $stat['symbol'] }}</h4>
                    <p class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.2em]">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Features Matrix -->
        <section id="features" class="py-32 z-10 relative">
            <div class="max-w-7xl mx-auto px-8 space-y-24">
                <div class="space-y-4 text-center">
                    <h2 class="text-5xl lg:text-7xl font-black tracking-tighter italic">SYSTEM <span class="text-gradient">CAPABILITIES</span></h2>
                    <p class="text-zinc-500 text-lg font-medium max-w-xl mx-auto">An autonomous ecosystem for performance synchronization.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([
                        ['title' => 'Continuous Evaluation', 'desc' => 'Replace subjective annual reviews with real-time behavioral synchronization.', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                        ['title' => 'Predictive Ranking', 'desc' => 'Identify potential leadership velocity before it surfaces in traditional metrics.', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                        ['title' => 'Neural Benchmarking', 'desc' => 'Compare internal performance logic against global industry peak benchmarks.', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ] as $feat)
                    <div class="p-10 rounded-[32px] bg-white/5 border border-white/10 hover:border-indigo-500/50 transition-all group backdrop-blur-xl relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 text-indigo-500/5 group-hover:text-indigo-500/10 transition-colors">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $feat['icon'] }}"/></svg>
                        </div>
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-8 shadow-xl shadow-indigo-600/20 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feat['icon'] }}"/></svg>
                        </div>
                        <h4 class="text-2xl font-black italic mb-4 tracking-tight uppercase tracking-tighter">{{ $feat['title'] }}</h4>
                        <p class="text-zinc-500 font-medium leading-relaxed">{{ $feat['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-48 z-10 relative">
            <div class="max-w-5xl mx-auto px-8 text-center space-y-12">
                <h2 class="text-6xl lg:text-8xl font-black tracking-tighter italic">READY FOR <span class="text-gradient">ASCENSION?</span></h2>
                <p class="text-xl text-zinc-400 font-medium max-w-2xl mx-auto">Initialize the MQ protocol for your organization today.</p>
                <div class="pt-8">
                     <a href="{{ route('register') }}" class="mq-button-primary !py-6 !px-16 !text-sm uppercase tracking-[0.4em]">Establish Link</a>
                </div>
            </div>
        </section>

        <footer class="py-12 border-t border-white/5 text-center relative z-10 px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
                <span class="text-[10px] font-black text-zinc-600 uppercase tracking-widest">© 2024 MQ NEURAL PLATFORM. CODED FOR EXCELLENCE.</span>
                <div class="flex gap-10">
                    <a href="#" class="text-[9px] font-black text-zinc-600 uppercase tracking-widest hover:text-white transition-colors">Privacy Neural Logic</a>
                    <a href="#" class="text-[9px] font-black text-zinc-600 uppercase tracking-widest hover:text-white transition-colors">Service Protocol</a>
                </div>
            </div>
        </footer>

        <script>
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('nav');
                if (window.scrollY > 50) {
                    nav.classList.add('h-20', 'bg-zinc-950/80');
                    nav.classList.remove('h-24', 'bg-zinc-950/20');
                } else {
                    nav.classList.remove('h-20', 'bg-zinc-950/80');
                    nav.classList.add('h-24', 'bg-zinc-950/20');
                }
            });
        </script>
    </body>
</html>
