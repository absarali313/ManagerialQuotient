<x-frontend-layout>
    <div class="space-y-28 pb-32">
        
        <!-- Hero Section -->
        <section class="relative pt-12 overflow-hidden">
            <div class="max-w-[1224px] mx-auto px-6 lg:px-0">
                <div class="lg:flex lg:items-center lg:gap-14">
                    <div class="lg:w-1/2 space-y-5 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold tracking-widest uppercase">
                            <x-lucide-sparkles class="w-3 h-3" />
                            Performance Intelligence
                        </div>
                        <h1 class="text-5xl sm:text-6xl font-extrabold font-outfit leading-[1.1] text-gray-900 tracking-tight">
                            Powerful Features for <br><span class="text-blue-600">Performance Intelligence</span>
                        </h1>
                        <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                            Continuous, AI-driven decision system. Gain full visibility into workforce performance with real-time tracking and predictive analytics.
                        </p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-md shadow-blue-500/20 hover:bg-blue-700 hover:-translate-y-0.5 transition-all">Get Started</a>
                            <a href="#" class="px-6 py-3 bg-white text-gray-700 border border-gray-200 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
                                <x-lucide-play-circle class="w-3.5 h-3.5 text-blue-600" />
                                Demo
                            </a>
                        </div>
                    </div>
                    
                    <div class="lg:w-1/2 mt-10 lg:mt-0 relative">
                        <div class="relative z-10 bg-white/40 p-1 rounded-3xl shadow-lg backdrop-blur-sm border border-white/40 max-w-md mx-auto lg:ml-auto">
                            <img src="{{ asset('assets/images/dashboard_mockup.jpg') }}" alt="MQ Dashboard" class="rounded-2xl shadow-inner w-full">
                            
                            <!-- Floating Stat (Scaled even smaller) -->
                            <div class="absolute -top-4 -left-4 bg-white p-2.5 rounded-lg shadow-md border border-gray-100 animate-bounce" style="animation-duration: 3s">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-green-100 rounded flex items-center justify-center">
                                        <x-lucide-trending-up class="w-3 h-3 text-green-600" />
                                    </div>
                                    <div>
                                        <p class="text-[9px] text-gray-500 font-bold leading-none">Growth</p>
                                        <p class="text-xs font-black text-gray-900">+12%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Problems vs Solutions -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Problems -->
                <div class="space-y-5">
                    <h2 class="text-lg font-black font-outfit text-gray-900 border-l-4 border-red-500 pl-3 uppercase tracking-wider">Traditional HR Gaps</h2>
                    <div class="space-y-3">
                        @foreach(['Static Metrics' => 'Limited insights.',
                                  'Subjective Methods' => 'Bias and inconsistency.',
                                  'No Real-time Data' => 'Missing growth metrics.'] as $title => $desc)
                            <div class="ml-2 bg-red-50/50 p-3.5 rounded-xl border border-red-100 flex gap-3 items-center shadow-sm shadow-red-500/5">
                                <x-lucide-x-circle class="w-4 h-4 text-red-500 shrink-0" />
                                <div class="flex items-center gap-2">
                                    <h4 class="text-gray-900 font-bold text-[13px]">{{ $title }}:</h4>
                                    <p class="text-xs text-gray-500">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Solutions -->
                <div class="space-y-5">
                    <h2 class="text-lg font-black font-outfit text-gray-900 border-l-4 border-green-500 pl-3 uppercase tracking-wider">MQ Solutions</h2>
                    <div class="space-y-3">
                        @foreach(['Continuous Evaluation' => 'Real-time cycles.',
                                  'AI-Powered Decisions' => 'Objective logic.',
                                  'Live Ranking' => 'Live leaderboards.'] as $title => $desc)
                            <div class="ml-2 bg-green-50/50 p-3.5 rounded-xl border border-green-100 flex gap-3 items-center shadow-sm shadow-green-500/5">
                                <x-lucide-check-circle-2 class="w-4 h-4 text-green-500 shrink-0" />
                                <div class="flex items-center gap-2">
                                    <h4 class="text-gray-900 font-bold text-[13px]">{{ $title }}:</h4>
                                    <p class="text-xs text-gray-500">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Core System Capabilities -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0 space-y-12">
            <div class="text-center space-y-2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">System Capabilities</h2>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">Everything MQ does to transform performance.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                @php
                $capabilities = [
                    ['icon' => 'lucide-settings-2', 'color' => 'blue', 'title' => 'KPI Weighting', 'desc' => 'Role-based customization.'],
                    ['icon' => 'lucide-refresh-cw', 'color' => 'green', 'title' => 'Evaluation Engine', 'desc' => 'Auto-assessment cycles.'],
                    ['icon' => 'lucide-bar-chart-3', 'color' => 'purple', 'title' => 'Ranking', 'desc' => 'Real-time leaderboards.'],
                    ['icon' => 'lucide-calendar', 'color' => 'blue', 'title' => 'Timeline Tracking', 'desc' => 'Historical growth charts.'],
                    ['icon' => 'lucide-check-circle', 'color' => 'green', 'title' => 'Promotion AI', 'desc' => 'Predictive advancement scoring.'],
                    ['icon' => 'lucide-alert-triangle', 'color' => 'red', 'title' => 'Real-Time Alerts', 'desc' => 'Triggered notifications.'],
                ];
                @endphp

                @foreach($capabilities as $cap)
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
                        <div class="w-9 h-9 bg-{{ $cap['color'] }}-50 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <x-dynamic-component :component="$cap['icon']" class="w-4 h-4 text-{{ $cap['color'] }}-600" />
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-1 leading-tight">{{ $cap['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-tight">{{ $cap['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- AI Intelligence Layer -->
        <section class="bg-gray-50/40 py-28 border-y border-gray-100/40">
            <div class="max-w-[1224px] mx-auto px-6 lg:px-0 space-y-16">
                <div class="text-center space-y-2">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight uppercase">AI Intelligence Layer</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    <!-- AI Performance Summary -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center">
                                <x-lucide-brain-circuit class="w-4 h-4 text-indigo-600" />
                            </div>
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded-md text-[9px] font-bold uppercase tracking-wider">AI Insight</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-base font-black text-gray-900">Performance Summary</h3>
                            <p class="text-xs text-gray-500 italic">"Sarah's productivity improved by 15%. Focus on frontend reduced bugs."</p>
                        </div>
                    </div>

                    <!-- AI Promotion Prediction -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                                <x-lucide-rocket class="w-4 h-4 text-purple-600" />
                            </div>
                            <span class="px-2 py-0.5 bg-purple-50 text-purple-700 rounded-md text-[9px] font-bold uppercase tracking-wider">Predictive</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-base font-black text-gray-900">Promotion Prediction</h3>
                            <div class="flex gap-2 pt-1">
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-[9px] font-bold">Ready</span>
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 rounded text-[9px] font-bold">Potential</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-5">
                    <!-- Skill Gap Detection -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center">
                                <x-lucide-search class="w-4 h-4 text-pink-500" />
                            </div>
                            <span class="px-2 py-0.5 bg-pink-50 text-pink-700 rounded-md text-[9px] font-bold uppercase tracking-wider">Gap Analysis</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-base font-black text-gray-900">Skill Gap Detection</h3>
                            <p class="text-xs text-gray-500 italic">"Identifies 3 critical missing competencies in the current Senior Lead pipeline."</p>
                        </div>
                    </div>

                    <!-- Attitude Detection -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                                <x-lucide-activity class="w-4 h-4 text-orange-500" />
                            </div>
                            <span class="px-2 py-0.5 bg-orange-50 text-orange-700 rounded-md text-[9px] font-bold uppercase tracking-wider">Sentiment AI</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-base font-black text-gray-900">Attitude Detection</h3>
                            <p class="text-xs text-gray-500 italic">"Detected a 12% positive shift in team sentiment after the Q1 evaluation cycle."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- What Makes MQ Different -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0">
            <div class="bg-yellow-50/20 py-24 rounded-[3rem] px-12 space-y-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 text-center tracking-tight uppercase">What Makes Us Different</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach(['Standardization', 'Leaderboards', 'Exec Reports', 'Readiness', 'Benchmarks', 'Secure'] as $item)
                        <div class="bg-white p-5 rounded-xl border border-yellow-100 text-center space-y-2">
                            <div class="w-8 h-8 bg-yellow-50 rounded-lg flex items-center justify-center mx-auto">
                                <x-lucide-star class="w-4 h-4 text-yellow-500" />
                            </div>
                            <h4 class="text-xs font-black text-gray-900 leading-tight">{{ $item }}</h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0">
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[3rem] p-16 text-center space-y-8 shadow-lg relative overflow-hidden">
                <h2 class="text-2xl sm:text-3xl font-black font-outfit text-white tracking-tight">
                    Scale Your Performance Intelligence
                </h2>
                <div class="flex flex-wrap justify-center gap-3 text-center">
                    <a href="#" class="px-7 py-3 bg-white text-blue-600 rounded-lg font-bold text-sm shadow-md hover:-translate-y-0.5 transition-all">Get Started</a>
                    <a href="#" class="px-7 py-3 bg-transparent text-white border-2 border-white/20 rounded-lg font-bold text-sm hover:bg-white/5 transition-all">Request Demo</a>
                </div>
            </div>
        </section>

    </div>
</x-frontend-layout>
