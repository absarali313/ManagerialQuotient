<x-frontend-layout>
    <div class="space-y-28 pb-32">
        
        <!-- Hero Section -->
        <section class="relative pt-12 overflow-hidden">
            <div class="max-w-[1224px] mx-auto px-6 lg:px-0">
                <div class="lg:flex lg:items-center lg:gap-14">
                    <div class="lg:w-1/2 space-y-5 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold tracking-widest uppercase">
                            <x-lucide-building-2 class="w-3 h-3" />
                            Enterprise Grade Performance
                        </div>
                        <h1 class="text-5xl sm:text-6xl font-extrabold font-outfit leading-[1.1] text-gray-900 tracking-tight">
                            Scale Excellence Across Your <br><span class="text-blue-600">Entire Organization</span>
                        </h1>
                        <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                            The definitive OS for organizational performance. Create KPI-driven assessments, rank talent objectively, and bridge skill gaps with AI-driven precision.
                        </p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            <a href="#" class="px-6 py-3 bg-[#5D45FD] text-white rounded-xl font-bold text-sm shadow-lg shadow-indigo-500/20 hover:bg-[#4C36E0] hover:-translate-y-0.5 transition-all">Start Your Organization</a>
                            <a href="#" class="px-6 py-3 bg-white text-gray-700 border border-gray-200 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
                                <x-lucide-presentation class="w-3.5 h-3.5 text-blue-600" />
                                Portfolio Demo
                            </a>
                        </div>
                    </div>
                    
                    <div class="lg:w-1/2 mt-10 lg:mt-0 relative">
                        <div class="relative z-10 bg-white/40 p-1 rounded-3xl shadow-lg backdrop-blur-sm border border-white/40 max-w-md mx-auto lg:ml-auto">
                            <img src="{{ asset('assets/images/dashboard_mockup.jpg') }}" alt="MQ Enterprise Dashboard" class="rounded-2xl shadow-inner w-full">
                            
                            <!-- Floating KPI Tag -->
                            <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-100 animate-pulse">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded flex items-center justify-center">
                                        <x-lucide-activity class="w-4 h-4" />
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Org Accuracy</p>
                                        <p class="text-sm font-black text-gray-900">99.2% RECOGNITION</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 1: FOR ORGANIZATIONS (THE MAJOR PART) -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0">
            <div class="grid lg:grid-cols-12 gap-16 items-center">
                <div class="lg:col-span-5 space-y-8">
                    <div class="space-y-4">
                        <h2 class="text-sm font-black text-blue-600 uppercase tracking-[0.2em]">01. Organizational Mastery</h2>
                        <h3 class="text-4xl font-bold text-gray-900 tracking-tight leading-tight">Objective Intelligence for High-Performance Teams</h3>
                        <p class="text-gray-600 leading-relaxed">MQ transforms traditional HR into a precision-engineered intelligence system. Define what success looks like, and let AI keep your team aligned.</p>
                    </div>

                    <div class="space-y-4">
                        @foreach([
                            'Custom KPI Engine' => 'Map assessments directly to your company\'s unique performance indicators.',
                            'Automated Evaluation Cycles' => 'Set recurrences for weekly, monthly, or quarterly assessment loops.',
                            'Dynamic Talent Ranking' => 'Compare performance across departments with real-time, bias-free leaderboards.',
                            'Skill Gap Visualization' => 'Identify exactly where your organization is losing efficiency with AI depth.'
                        ] as $title => $desc)
                            <div class="flex gap-4 p-4 rounded-2xl hover:bg-white hover:shadow-xl hover:shadow-black/5 transition-all group">
                                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                    <x-lucide-check-circle-2 class="w-5 h-5" />
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-gray-900 font-bold text-base">{{ $title }}</h4>
                                    <p class="text-sm text-gray-500 leading-normal">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-7 bg-gray-50/80 rounded-[2.5rem] p-10 border border-gray-100 flex items-center justify-center relative overflow-hidden group">
                    {{-- Decorative Elements --}}
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl group-hover:bg-blue-400/20 transition-all duration-700"></div>
                    
                    <div class="bg-white p-6 rounded-3xl shadow-2xl border border-white shadow-blue-900/10 w-full relative z-10 transform group-hover:scale-[1.02] transition-transform duration-500">
                         <div class="flex items-center justify-between mb-8">
                            <h4 class="font-bold text-gray-900">Department Benchmarking</h4>
                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">LIVE PREVIEW</span>
                         </div>
                         <div class="space-y-6">
                            @foreach(['Engineering' => 88, 'Marketing' => 74, 'Sales' => 92] as $dept => $score)
                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-bold uppercase tracking-wider">
                                        <span class="text-gray-500">{{ $dept }}</span>
                                        <span class="text-gray-900">{{ $score }}%</span>
                                    </div>
                                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-blue-600 rounded-full" style="width: {{ $score }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                         </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: FOR INDIVIDUALS (INDIVIDUAL USE FEATURE) -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0">
            <div class="bg-gray-900 rounded-[3rem] p-12 lg:p-20 relative overflow-hidden">
                {{-- Abstract background effect --}}
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(99,102,241,0.15),transparent)] pointer-events-none"></div>
                
                <div class="grid lg:grid-cols-2 gap-16 items-center relative z-10">
                    <div class="order-2 lg:order-1">
                        <div class="grid grid-cols-2 gap-4">
                            @foreach([
                                ['Self-Growth Roadmap', 'Individualized pathing based on current scores.', 'lucide-map'],
                                ['Industry Benchmarking', 'See how you stack up against top experts.', 'lucide-globe'],
                                ['Competency Badges', 'Showcase validated strengths to stakeholders.', 'lucide-award'],
                                ['Daily Micro-Insights', 'Small sessions for consistent performance gain.', 'lucide-zap']
                            ] as $item)
                                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-2xl space-y-3 hover:bg-white/10 transition-all cursor-default">
                                    <div class="w-10 h-10 bg-indigo-500/20 text-indigo-400 rounded-xl flex items-center justify-center">
                                        <x-dynamic-component :component="$item[2]" class="w-5 h-5" />
                                    </div>
                                    <h5 class="text-white font-bold text-sm leading-tight">{{ $item[0] }}</h5>
                                    <p class="text-gray-400 text-xs leading-relaxed">{{ $item[1] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-6 order-1 lg:order-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 text-indigo-300 rounded-full text-[10px] font-bold tracking-widest uppercase border border-white/10">
                            <x-lucide-user class="w-3 h-3" />
                            For Individuals
                        </div>
                        <h2 class="text-4xl font-bold text-white tracking-tight leading-tight">Empower Every Individual to Lead</h2>
                        <p class="text-gray-400 leading-relaxed">Beyond organizational oversight, MQ serves as a personal performance coach. We give employees the data they need to own their career trajectory and benchmark their growth against global standards.</p>
                        <div class="pt-4">
                            <a href="#" class="text-indigo-400 hover:text-indigo-300 font-bold text-sm flex items-center gap-2 group transition-all">
                                Learn about the growth path
                                <x-lucide-arrow-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final System Capabilities (Balanced Grid) -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0 space-y-12">
            <div class="text-center space-y-2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight font-display">Unified Performance Logic</h2>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">The technology that powers both organizational scale and individual success.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                $capabilities = [
                    ['icon' => 'lucide-settings-2', 'color' => 'blue', 'title' => 'KPI Weighting Engine', 'desc' => 'Fine-tune metrics for every role.'],
                    ['icon' => 'lucide-refresh-cw', 'color' => 'green', 'title' => 'Evaluation Orchestration', 'desc' => 'Auto-pilot assessment workflows.'],
                    ['icon' => 'lucide-bar-chart-3', 'color' => 'purple', 'title' => 'Real-Time Rank Engine', 'desc' => 'Live leaderboards for top talent.'],
                    ['icon' => 'lucide-brain-circuit', 'color' => 'indigo', 'title' => 'Insight Generation', 'desc' => 'AI summaries of performance trends.'],
                    ['icon' => 'lucide-rocket', 'color' => 'rose', 'title' => 'Promotion Forecasting', 'desc' => 'Predictive advancement scoring.'],
                    ['icon' => 'lucide-shield-check', 'color' => 'emerald', 'title' => 'Secure Compliance', 'desc' => 'Enterprise-grade data security.']
                ];
                @endphp

                @foreach($capabilities as $cap)
                    <div class="bg-white p-7 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group border-b-4 border-b-{{ $cap['color'] }}-500/10">
                        <div class="w-12 h-12 bg-{{ $cap['color'] }}-50 text-{{ $cap['color'] }}-600 rounded-2xl flex items-center justify-center mb-5 group-hover:rotate-6 transition-transform">
                            <x-dynamic-component :component="$cap['icon']" class="w-6 h-6" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $cap['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $cap['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Final CTA -->
        <section class="max-w-[1224px] mx-auto px-6 lg:px-0">
            <div class="bg-gradient-to-br from-[#5D45FD] to-[#3B26CC] rounded-[4rem] p-16 text-center space-y-10 shadow-2xl shadow-indigo-200 relative overflow-hidden group">
                {{-- Decorative pulse --}}
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.1),transparent)] group-hover:scale-150 transition-transform duration-1000"></div>

                <div class="relative z-10 space-y-4">
                    <h2 class="text-3xl sm:text-5xl font-black font-outfit text-white tracking-tight">
                        Transform Your Organization Today
                    </h2>
                    <p class="text-white/70 text-lg max-w-xl mx-auto">Join the world's most intelligent companies in scaling performance through data, not intuition.</p>
                </div>
                
                <div class="relative z-10 flex flex-wrap justify-center gap-4 text-center">
                    <a href="#" class="px-8 py-4 bg-white text-[#5D45FD] rounded-2xl font-bold text-base shadow-xl hover:-translate-y-1 transition-all">Setup My Organization</a>
                    <a href="#" class="px-8 py-4 bg-transparent text-white border-2 border-white/20 rounded-2xl font-bold text-base hover:bg-white/10 transition-all">Explore for Individuals</a>
                </div>
            </div>
        </section>

    </div>
</x-frontend-layout>
