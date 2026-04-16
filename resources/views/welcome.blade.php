<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Managerial Quotient - AI Performance Management</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
            .bg-grid-pattern {
                background-image: linear-gradient(to right, #f1f5f9 1px, transparent 1px), linear-gradient(to bottom, #f1f5f9 1px, transparent 1px);
                background-size: 40px 40px;
            }
        </style>
    </head>
    <body class="antialiased bg-white text-slate-900 overflow-x-hidden selection:bg-blue-500 selection:text-white">

        <!-- Navigation -->
        <nav class="fixed w-full z-50 top-0 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                <div class="flex items-center gap-12">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center font-black text-xl shadow-sm text-white">MQ</div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Managerial Quotient</span>
                    </a>
                    <div class="hidden lg:flex items-center gap-8">
                        <a href="#features" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Features</a>
                        <a href="#how-it-works" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">How it Works</a>
                        <a href="#benefits" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Benefits</a>
                        <a href="#pricing" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors">Pricing</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-sm font-semibold text-slate-600 hover:text-blue-600 transition-colors px-4">Log In</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-sm">Get Started</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 px-6 overflow-hidden">
            <div class="absolute inset-0 bg-grid-pattern opacity-50 pointer-events-none -z-10"></div>
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-50/50 rounded-full blur-[100px] -z-10 translate-x-1/3 -translate-y-1/3"></div>
            
            <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8 relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-xs font-semibold">
                        <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                        PERFORMANCE INTELLIGENCE
                    </div>

                    <h1 class="text-5xl lg:text-[4rem] lg:leading-[1.1] font-extrabold tracking-tight text-slate-900">
                        Measure. Rank.<br/>
                        <span class="text-blue-600">Improve Your<br/>Team with AI.</span>
                    </h1>

                    <p class="text-lg text-slate-500 max-w-lg leading-relaxed font-medium">
                        Gain 360-degree insights on employee engagement, skills, and performance timelines. Empower your organization.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 text-white rounded-xl font-semibold text-base hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20 text-center">
                            Get Started Free
                        </a>
                        <button class="px-8 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-xl font-semibold text-base hover:border-slate-300 hover:bg-slate-50 transition-all text-center">
                            Book a Demo
                        </button>
                    </div>

                    <div class="grid grid-cols-3 gap-6 pt-10 border-t border-slate-100 mt-10">
                        <div>
                            <p class="text-3xl font-black text-slate-900">10K+</p>
                            <p class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wider">Organizations</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-slate-900">500K+</p>
                            <p class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wider">Assessments</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-slate-900">98%</p>
                            <p class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wider">Satisfaction</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Graphic Mockup -->
                <div class="relative z-10 w-full h-[500px] md:h-[600px] flex items-center justify-center">
                    <div class="w-full max-w-lg bg-white rounded-3xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] border border-slate-100 p-6 space-y-6 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                        <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                            <div>
                                <h4 class="font-bold text-slate-900">Team Performance</h4>
                                <p class="text-xs text-slate-500">Q2 2024 Analytics</p>
                            </div>
                            <button class="px-3 py-1.5 bg-purple-100 text-purple-700 rounded-lg text-xs font-bold">+ Evaluate</button>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-slate-50 rounded-xl p-3">
                                <p class="text-[10px] text-slate-500 font-bold uppercase mb-1">Avg Score</p>
                                <p class="text-2xl font-black text-slate-900">82.4</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-3">
                                <p class="text-[10px] text-emerald-600 font-bold uppercase mb-1">Trajectory</p>
                                <p class="text-2xl font-black text-emerald-700">+15%</p>
                            </div>
                            <div class="bg-rose-50 rounded-xl p-3">
                                <p class="text-[10px] text-rose-600 font-bold uppercase mb-1">Risk Level</p>
                                <p class="text-2xl font-black text-rose-700">Low</p>
                            </div>
                        </div>

                        <div class="pt-4 space-y-2">
                            <p class="text-xs font-bold text-slate-900">Competency Breakdown</p>
                            <div class="flex items-end gap-2 h-32 pt-4">
                                <div class="w-full bg-blue-100 rounded-t-md h-12 relative group"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold">42%</div></div>
                                <div class="w-full bg-blue-500 rounded-t-md h-20 relative group"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold">78%</div></div>
                                <div class="w-full bg-indigo-500 rounded-t-md h-14 relative group"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold">55%</div></div>
                                <div class="w-full bg-purple-500 rounded-t-md h-24 relative group"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold">92%</div></div>
                                <div class="w-full bg-fuchsia-400 rounded-t-md h-16 relative group"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 text-[10px] font-bold">65%</div></div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-4 border-t border-slate-100">
                            @foreach([
                                ['name' => 'Sarah Chen', 'role' => 'Senior Developer', 'score' => 96, 'color' => 'bg-emerald-500'],
                                ['name' => 'Marcus Doe', 'role' => 'Product Manager', 'score' => 88, 'color' => 'bg-blue-500']
                            ] as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center font-bold text-xs text-slate-600">{{ substr($user['name'],0,1) }}</div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $user['name'] }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $user['role'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden"><div class="{{ $user['color'] }} h-full" style="width:{{ $user['score'] }}%"></div></div>
                                    <span class="text-xs font-bold text-slate-700">{{ $user['score'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- The Old Way vs The MQ Way -->
        <section class="py-24 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">The Old Way vs. The MQ Way</h2>
                    <p class="text-slate-500 text-lg">See why modern companies are shifting towards continuous performance intelligence.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Old Way -->
                    <div class="bg-red-50/50 border border-red-100 rounded-3xl p-8 lg:p-12">
                        <div class="flex items-center gap-3 mb-8 pb-6 border-b border-red-100">
                            <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-red-900">Traditional Methods</h3>
                        </div>
                        <ul class="space-y-6">
                            @foreach([
                                'High Turnover / Attrition' => 'Losing key talent due to poor feedback structures and lack of transparency.',
                                'Rare & Stressful Reviews' => 'Annual or bi-annual reviews that cause anxiety and focus heavily on recent recency bias.',
                                'Subjective Decisions' => 'Based on instincts and incomplete memory rather than data.',
                                'Low Engagement' => 'Employees feel stuck, unheard, and unmotivated by static goals.'
                            ] as $title => $desc)
                            <li class="flex gap-4">
                                <div class="mt-1 flex-shrink-0 w-6 h-6 rounded-full bg-red-200 text-red-600 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $title }}</h4>
                                    <p class="text-sm text-slate-500 mt-1">{{ $desc }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- MQ Way -->
                    <div class="bg-emerald-50/50 border border-emerald-100 rounded-3xl p-8 lg:p-12 relative overflow-hidden shadow-lg shadow-emerald-500/5">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
                        <div class="flex items-center gap-3 mb-8 pb-6 border-b border-emerald-100 relative z-10">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <h3 class="text-2xl font-bold text-emerald-900">MQ Solutions</h3>
                        </div>
                        <ul class="space-y-6 relative z-10">
                            @foreach([
                                'Retain Top Performers' => 'Identify potential flight risks proactively with AI-driven engagement analysis.',
                                'Continuous Feedback' => 'Create a culture of constant communication, support, and immediate course correction.',
                                'Data-Driven Decisions' => 'Identify true leaders based on peer analytics and objective tracking.',
                                'Boost Engagement' => 'Clear goals, transparent expectations, and continuous recognition drives performance.'
                            ] as $title => $desc)
                            <li class="flex gap-4">
                                <div class="mt-1 flex-shrink-0 w-6 h-6 rounded-full bg-emerald-200 text-emerald-700 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $title }}</h4>
                                    <p class="text-sm text-slate-600 mt-1">{{ $desc }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Grid -->
        <section id="features" class="py-24 bg-slate-50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Powerful Features for Modern Teams</h2>
                    <p class="text-slate-500 text-lg">Everything your organization needs to measure and manage performance.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                    @foreach([
                        ['t' => 'Continuous Evaluation', 'd' => 'Replace subjective annual reviews with an automated framework for continuous behavior tracked.', 'c' => 'blue', 'i' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                        ['t' => 'Employee Ranking', 'd' => 'Understand who your top performers are based on normalized metrics via automated data.', 'c' => 'purple', 'i' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6'],
                        ['t' => 'Performance Timeline', 'd' => 'Map employee growth trajectories clearly with visual dashboards that track past progression.', 'c' => 'emerald', 'i' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['t' => 'Promotion Engine', 'd' => 'Identify readiness for promotion automatically based on pre-defined competency benchmarks.', 'c' => 'rose', 'i' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                        ['t' => 'KPI Tracking', 'd' => 'Set objectives and key results (OKRs) and track them real-time natively integrated.', 'c' => 'amber', 'i' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                        ['t' => 'Real-Time Alerts', 'd' => 'Stay ahead of potential bottlenecks. Get notified automatically if critical paths delay.', 'c' => 'indigo', 'i' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                    ] as $f)
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 rounded-xl bg-{{ $f['c'] }}-50 text-{{ $f['c'] }}-600 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['i'] }}"/></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">{{ $f['t'] }}</h4>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $f['d'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- AI Purple Section -->
        <section class="py-24 bg-purple-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <p class="text-sm font-bold text-purple-600 tracking-widest uppercase mb-2">AI-Powered Analytics</p>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-4 tracking-tight">AI That Understands Your Workforce</h2>
                    <p class="text-slate-600 text-lg max-w-2xl mx-auto">Advanced neural learning models process your continuous feedback loops natively.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach([
                        ['t' => 'Performance Summary', 'd' => 'AI dynamically generates text summaries of strengths and weaknesses based on multi-source data.', 'c' => 'purple', 'stat' => 'Generated instantly'],
                        ['t' => 'Retention Prediction', 'd' => 'Machine learning evaluates activity models to flag potential churn risks proactively.', 'c' => 'emerald', 'stat' => '85% Accuracy', 'prog' => 85],
                        ['t' => 'Skill Gap Detection', 'd' => 'Automatically identifies areas where your workforce lacks required capabilities relative to goals.', 'c' => 'rose', 'stat' => '+12 Areas Found'],
                        ['t' => 'Sentiment', 'd' => 'Monitors behavioral changes to flag workplace burnout and overall sentiment logic.', 'c' => 'blue', 'stat' => 'Positive Trend']
                    ] as $ai)
                    <div class="bg-white p-6 rounded-2xl border border-purple-100 shadow-sm flex flex-col justify-between hover:-translate-y-1 transition-transform">
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-{{ $ai['c'] }}-50 text-{{ $ai['c'] }}-600 flex items-center justify-center mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h4 class="font-bold text-slate-900 mb-2">{{ $ai['t'] }}</h4>
                            <p class="text-slate-500 text-sm mb-6">{{ $ai['d'] }}</p>
                        </div>
                        <div>
                            @if(isset($ai['prog']))
                            <div class="w-full bg-slate-100 h-1.5 rounded-full mb-2 overflow-hidden">
                                <div class="bg-emerald-500 h-full" style="width: {{ $ai['prog'] }}%"></div>
                            </div>
                            @endif
                            <span class="text-xs font-bold text-{{ $ai['c'] }}-600 uppercase tracking-wider">{{ $ai['stat'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Dashboard Image Section -->
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="max-w-5xl mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6 tracking-tight">Everything You Need in One Intelligent Dashboard</h2>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto mb-16">A unified intuitive interface for managers, HR teams, and directly accessible employees with customized layouts and permissions.</p>

                <!-- MacOS Window Mockup -->
                <div class="relative w-full max-w-4xl mx-auto bg-white rounded-[24px] border border-slate-200 shadow-2xl overflow-hidden">
                    <!-- Browser Header -->
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    </div>
                    
                    <!-- Dashboard Content HTML Representation -->
                    <div class="p-8 bg-slate-50/50 text-left">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-xl font-bold text-slate-900">Organization Overview</h3>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-bold shadow-sm">View Report</button>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4 mb-8">
                            @foreach([
                                ['t' => 'Total Employees', 'v' => '1,247', 'c' => '+12%'],
                                ['t' => 'Average Score', 'v' => '82.4', 'c' => '+5.2%'],
                                ['t' => 'Goal Completion', 'v' => '92.4%', 'c' => '+2.1%'],
                                ['t' => 'Risk Factors', 'v' => '28', 'c' => '-4', 'neg' => true]
                            ] as $stat)
                            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm text-center">
                                <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold mb-1">{{ $stat['t'] }}</p>
                                <p class="text-2xl font-black text-slate-900">{{ $stat['v'] }}</p>
                                <p class="text-xs font-bold mt-1 {{ isset($stat['neg']) ? 'text-emerald-500' : 'text-emerald-500' }}">{{ $stat['c'] }}</p>
                            </div>
                            @endforeach
                        </div>

                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="col-span-2 bg-white p-6 rounded-xl border border-slate-100 shadow-sm h-64 flex flex-col justify-between">
                                <p class="text-sm font-bold text-slate-900">Performance Trend</p>
                                <div class="w-full relative flex-1 mt-4">
                                    <svg class="w-full h-full" viewBox="0 0 100 40" preserveAspectRatio="none">
                                        <path d="M0,35 Q10,25 20,30 T40,20 T60,25 T80,10 T100,5 L100,40 L0,40 Z" fill="rgba(37,99,235,0.1)"></path>
                                        <path d="M0,35 Q10,25 20,30 T40,20 T60,25 T80,10 T100,5" fill="none" stroke="#2563EB" stroke-width="1.5"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="col-span-1 bg-white p-6 rounded-xl border border-slate-100 shadow-sm space-y-4">
                                <p class="text-sm font-bold text-slate-900">Top Performers</p>
                                @foreach(['Engineering', 'Marketing', 'Sales'] as $idx => $dept)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded bg-blue-50 text-blue-600 text-[10px] font-bold flex items-center justify-center">{{ $idx+1 }}</div>
                                        <p class="text-xs font-semibold text-slate-700">{{ $dept }}</p>
                                    </div>
                                    <span class="text-xs font-bold text-emerald-600">+12%</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-24 bg-slate-50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">How It Works</h2>
                <p class="text-slate-500 text-lg mb-16">A seamless process that literally simplifies complex operations.</p>

                <div class="flex flex-col md:flex-row justify-center items-center gap-8 md:gap-12 relative max-w-4xl mx-auto">
                    <!-- Connecting line (desktop only) -->
                    <div class="hidden md:block absolute top-[28px] left-[10%] right-[10%] h-[2px] bg-slate-200 z-0"></div>
                    
                    @foreach([
                        ['icon' => 'M12 4v16m8-8H4', 't' => 'Add Employees', 'color' => 'blue'],
                        ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 't' => 'Assign Assessments', 'color' => 'indigo'],
                        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 't' => 'AI Insights', 'color' => 'purple', 'active' => true],
                        ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 't' => 'Boost Performance', 'color' => 'emerald'],
                        ['icon' => 'M5 13l4 4L19 7', 't' => 'Goal Projection', 'color' => 'blue']
                    ] as $step)
                    <div class="relative z-10 flex flex-col items-center flex-1">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center mb-4 {{ isset($step['active']) ? 'bg-purple-600 text-white shadow-lg shadow-purple-500/30 ring-4 ring-purple-100 scale-110' : 'bg-white text-'.$step['color'].'-500 border-2 border-slate-100 hover:border-'.$step['color'].'-500 transition-colors' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/></svg>
                        </div>
                        <h4 class="text-xs font-bold text-slate-900 text-center uppercase tracking-wider">{{ $step['t'] }}</h4>
                        @if(isset($step['active']))
                            <p class="text-[10px] text-purple-600 mt-1">Automatic & Native</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Built for Everyone -->
        <section id="benefits" class="py-24 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Built for Everyone</h2>
                    <p class="text-slate-500 text-lg">The psychology supports both end validation points of the workforce hierarchy.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- For Organizations -->
                    <div class="bg-blue-50/30 border border-blue-100 rounded-3xl p-8 hover:shadow-lg transition-shadow bg-gradient-to-b from-transparent to-white">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">For Organizations</h3>
                        </div>
                        <ul class="space-y-6">
                            @foreach([
                                'Track Objective Decisions' => 'Let managers have the raw analytical data to make objective scaling decisions.',
                                'Better Resource Allocation' => 'Deploy teams dynamically where skill gaps require their particular attention.',
                                'Build a Connected Culture' => 'Allow transparency so leaders feel like they are contributing to an explicit outcome.',
                                'Drop Attrition' => 'Identify issues before people resign.'
                            ] as $title => $desc)
                            <li class="flex gap-4">
                                <div class="mt-1 flex-shrink-0 w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $title }}</h4>
                                    <p class="text-xs text-slate-500 mt-1">{{ $desc }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- For Employees -->
                    <div class="bg-emerald-50/30 border border-emerald-100 rounded-3xl p-8 hover:shadow-lg transition-shadow bg-gradient-to-b from-transparent to-white">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15.21 12a4 4 0 015.66 0M3.13 12a4 4 0 015.66 0M12 19.5c-4.418 0-8-1.79-8-4 0-.414.15-.812.435-1.168.083-.105.176-.205.276-.301m14.578 1.469c.285.356.435.754.435 1.168 0 2.21-3.582 4-8 4m-8-4c0-.986.966-1.854 2.614-2.585m10.772 0c1.648.731 2.614 1.599 2.614 2.585M12 19.5v-6.5"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">For Employees</h3>
                        </div>
                        <ul class="space-y-6">
                            @foreach([
                                'Know Your Strength' => 'Visual representations of continuous data feedback loops for employees.',
                                'Track Your Growth' => 'Evaluate your timeline and compare it against standard organizational metrics.',
                                'Fair Recognition' => 'Know that your rewards and rankings are directly tied to documented objective criteria.',
                                'Career Trajectory' => 'Understand what skills need to organically grow.'
                            ] as $title => $desc)
                            <li class="flex gap-4">
                                <div class="mt-1 flex-shrink-0 w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $title }}</h4>
                                    <p class="text-xs text-slate-500 mt-1">{{ $desc }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reports & Insights -->
        <section class="py-24 bg-slate-50 border-y border-slate-100">
            <div class="max-w-5xl mx-auto px-6 text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Comprehensive Reports & Insights</h2>
                <p class="text-slate-500 text-lg">Generate analytical, presentable reporting outputs with one interactive click.</p>
            </div>

            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    @foreach([
                        ['title' => 'Executive Summary', 'desc' => 'High level team summary for upper executive review.', 'c' => 'blue', 'i' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['title' => 'Training Needs', 'desc' => 'Identify gaps visually for actionable HR training logic.', 'c' => 'emerald', 'i' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['title' => 'Competency Matrices', 'desc' => 'Spider and radar graphs on unified skill matrices.', 'c' => 'purple', 'i' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['title' => 'KPI Reports', 'desc' => 'Downloadable OKR completion tracking sheets.', 'c' => 'rose', 'i' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10']
                    ] as $rep)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-8 h-8 rounded-lg bg-{{ $rep['c'] }}-50 text-{{ $rep['c'] }}-600 flex items-center justify-center mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $rep['i'] }}"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm mb-2">{{ $rep['title'] }}</h4>
                        <p class="text-xs text-slate-500 mb-4">{{ $rep['desc'] }}</p>
                        <a href="#" class="text-[10px] uppercase font-bold tracking-widest text-blue-600 hover:text-blue-800">View Example →</a>
                    </div>
                    @endforeach
                </div>

                <div class="bg-white border border-slate-200 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between gap-8 h-[200px]">
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-slate-900">Export & Share Reports</h3>
                        <p class="text-slate-500 text-sm">Distribute insightful analytics across your organization instantly via one single secure link format.</p>
                        <div class="flex gap-4 pt-2">
                            <span class="flex items-center gap-1 text-[10px] font-bold text-slate-600 uppercase tracking-widest"><div class="w-2 h-2 rounded bg-rose-500"></div> PDF Export</span>
                            <span class="flex items-center gap-1 text-[10px] font-bold text-slate-600 uppercase tracking-widest"><div class="w-2 h-2 rounded bg-emerald-500"></div> Excel Sheets</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 w-full md:w-64 h-full bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-center shadow-inner">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" class="py-24 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Simple, Transparent Pricing</h2>
                    <p class="text-slate-500 text-lg">Choose a plan that scales with your organization.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Starter Plan -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-lg transition-all flex flex-col">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-slate-900">Starter</h3>
                            <p class="text-sm text-slate-500 mt-2">Perfect for small teams getting started.</p>
                        </div>
                        <div class="mb-6 border-b border-slate-100 pb-6 flex-1">
                            <span class="text-4xl font-black text-slate-900">$29</span>
                            <span class="text-slate-500">/user/month</span>
                        </div>
                        <ul class="space-y-4 mb-8 text-sm text-slate-600">
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Up to 50 employees</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Basic AI Insights</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Standard Reporting</li>
                        </ul>
                        <button class="w-full py-3 rounded-xl border-2 border-slate-200 text-slate-900 font-bold hover:border-slate-300 transition-colors">Start Free Trial</button>
                    </div>
                    
                    <!-- Pro Plan -->
                    <div class="bg-blue-600 rounded-3xl p-8 shadow-xl shadow-blue-600/20 text-white relative transform md:-translate-y-4 flex flex-col">
                        <div class="absolute top-0 right-8 -translate-y-1/2 bg-gradient-to-r from-emerald-400 to-emerald-500 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest text-emerald-950">Most Popular</div>
                        <div class="mb-6">
                            <h3 class="text-xl font-bold">Professional</h3>
                            <p class="text-blue-200 text-sm mt-2">Advanced features for growing organizations.</p>
                        </div>
                        <div class="mb-6 border-b border-blue-500 pb-6 flex-1">
                            <span class="text-4xl font-black">$79</span>
                            <span class="text-blue-200">/user/month</span>
                        </div>
                        <ul class="space-y-4 mb-8 text-sm text-blue-100">
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Up to 500 employees</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Full AI Neural Processing</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> API Access</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Priority Support</li>
                        </ul>
                        <button class="w-full py-3 rounded-xl bg-white text-blue-600 font-bold hover:bg-slate-50 transition-colors">Start Free Trial</button>
                    </div>
                    
                    <!-- Enterprise Plan -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:shadow-lg transition-all flex flex-col md:col-span-2 lg:col-span-1">
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-slate-900">Enterprise</h3>
                            <p class="text-sm text-slate-500 mt-2">Custom logic for large scale applications.</p>
                        </div>
                        <div class="mb-6 border-b border-slate-100 pb-6 flex-1">
                            <span class="text-4xl font-black text-slate-900">Custom</span>
                        </div>
                        <ul class="space-y-4 mb-8 text-sm text-slate-600">
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Unlimited employees</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Custom AI Model Training</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> SCIM & SSO Integration</li>
                        </ul>
                        <button class="w-full py-3 rounded-xl border-2 border-slate-200 text-slate-900 font-bold hover:border-slate-300 transition-colors">Contact Sales</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer CTA -->
        <section class="bg-blue-600 text-white py-24 text-center mt-12 mb-0 relative overflow-hidden">
            <div class="absolute inset-0 bg-blue-700/20 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-500/40 via-transparent to-transparent"></div>
            <div class="max-w-2xl mx-auto px-6 relative z-10 space-y-8">
                <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight">Start Building a High-Performance Organization Today</h2>
                <p class="text-blue-100 text-lg">Join the enterprise logic that distinguishes standard workforce silos from autonomous high-output systems.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-blue-600 rounded-xl font-bold hover:bg-slate-50 transition-all shadow-md text-base">
                        Start Organization Free
                    </a>
                    <button class="px-8 py-4 bg-blue-700 hover:bg-blue-800 border border-blue-500 text-white rounded-xl font-bold transition-all text-base">
                        Contact Sales
                    </button>
                </div>
                <div class="flex items-center justify-center gap-6 pt-6 text-xs text-blue-200 font-medium">
                    <span class="flex items-center gap-1"><svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> 14-day absolute trial</span>
                    <span class="flex items-center gap-1"><svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> No credit card logic</span>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-[#0f172a] text-slate-400 py-12 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded bg-opacity-20 flex items-center justify-center text-blue-500 font-black text-xs">MQ</div>
                    <span class="font-bold text-white text-sm">Managerial Quotient</span>
                </div>
                <div class="text-xs">
                    &copy; {{ date('Y') }} Managerial Quotient Systems. Intelligence reserved.
                </div>
                <div class="flex gap-4 text-xs font-semibold">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Documentation</a>
                </div>
            </div>
        </footer>
    </body>
</html>
