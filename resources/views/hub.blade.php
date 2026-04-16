<x-app-layout>
    <div class="space-y-10 pb-12">
        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 py-4">
            <div class="space-y-2">
                <h1 class="text-5xl font-extrabold tracking-tighter text-zinc-900 dark:text-zinc-100">
                    Precision <span class="text-gradient">Intelligence</span>,<br/>
                    <span class="text-zinc-400 dark:text-zinc-500">{{ Auth::user()->name }}.</span>
                </h1>
                <p class="text-zinc-500 font-medium">Your managerial performance is currently <span class="text-indigo-600 font-black italic">Trending Upwards</span>.</p>
            </div>
            
            <!-- Current MQ Score Card -->
            <div class="glass-card w-full md:w-96 !p-8 relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-colors"></div>
                <div class="flex justify-between items-start mb-6">
                    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Personal MQ Index</span>
                    <span class="mq-badge mq-badge-primary">Tier 1 Elite</span>
                </div>
                <div class="flex items-end gap-3 mb-6">
                    <span class="text-6xl font-black text-zinc-900 dark:text-zinc-100 tracking-tighter italic">87.5</span>
                    <div class="mb-2">
                        <span class="text-xs font-bold text-emerald-500 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                            +4.2
                        </span>
                    </div>
                </div>
                <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-2.5 rounded-full overflow-hidden shadow-inner">
                    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 h-full rounded-full transition-all duration-1000 shadow-[0_0_10px_rgba(99,102,241,0.3)]" style="width: 87.5%"></div>
                </div>
                <div class="mt-4 flex justify-between text-[10px] font-bold text-zinc-400 uppercase tracking-tighter">
                    <span>Baseline: 72.0</span>
                    <span>Global Avg: 68.4</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-8">
            <div class="lg:col-span-3 space-y-8">
                <!-- Action Center -->
                <div class="glass-card flex flex-col h-full !p-0 overflow-hidden">
                    <div class="p-8 border-b border-zinc-200 dark:border-zinc-800 flex justify-between items-center bg-zinc-50/30 dark:bg-zinc-900/30">
                        <div>
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 flex items-center gap-2 italic">
                                Action Center
                            </h3>
                            <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mt-1">Intelligence-based Priorities</p>
                        </div>
                        <span class="mq-badge bg-rose-100 text-rose-700">3 Urgent</span>
                    </div>
                    
                    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        <!-- Assessment Task -->
                        <div class="p-8 flex items-center justify-between hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-all group">
                            <div class="flex gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-black text-zinc-900 dark:text-zinc-100">Continuum Assessment: Cycle 04</p>
                                    <p class="text-xs text-zinc-400 font-medium italic">Evaluation of "Strategic Delegation" skills required.</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="mq-badge mq-badge-primary !text-[8px]">Due in 4h</span>
                                        <span class="text-[9px] font-bold text-indigo-400 uppercase">Estimated time: 12 min</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('assessment') }}" class="mq-button-primary !py-2 !px-5 !text-[10px] uppercase tracking-widest shadow-none hover:shadow-indigo-500/20">Initialize</a>
                        </div>
                        
                        <!-- Feedback Task -->
                        <div class="p-8 flex items-center justify-between hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-all group">
                            <div class="flex gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-black text-zinc-900 dark:text-zinc-100">Team Qualitative Analysis</p>
                                    <p class="text-xs text-zinc-400 font-medium italic">3 team members requesting feedback synchronization.</p>
                                </div>
                            </div>
                            <button class="px-5 py-2.5 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl text-[10px] font-black text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 transition-all shadow-sm group-hover:border-indigo-500/30 uppercase tracking-widest">Execute</button>
                        </div>
                    </div>
                    <div class="p-4 bg-zinc-50/50 dark:bg-zinc-900/50 text-center">
                        <button class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.2em] hover:text-indigo-700 transition-colors">Load Archive</button>
                    </div>
                </div>
            </div>

            <!-- Skill Growth Radar -->
            <div class="lg:col-span-2 glass-card flex flex-col h-full relative overflow-hidden">
                <div class="absolute -left-6 -bottom-6 w-32 h-32 bg-purple-500/5 rounded-full blur-3xl"></div>
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-extrabold text-zinc-900 dark:text-zinc-100 italic">Competency Mapping</h3>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mt-1">Multi-dimensional Analysis</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>

                <div class="flex-1 flex flex-col items-center justify-center space-y-10 py-4">
                    <div class="w-full aspect-square max-w-[320px] relative">
                        <canvas id="skillRadarChart"></canvas>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="p-3 bg-zinc-50 dark:bg-zinc-900/50 rounded-2xl border border-zinc-100 dark:border-zinc-800">
                            <span class="text-[9px] font-black text-zinc-400 uppercase block mb-1">Strongest Pillar</span>
                            <span class="text-xs font-black text-emerald-500 uppercase">Innovation</span>
                        </div>
                        <div class="p-3 bg-zinc-50 dark:bg-zinc-900/50 rounded-2xl border border-zinc-100 dark:border-zinc-800">
                            <span class="text-[9px] font-black text-zinc-400 uppercase block mb-1">Growth Needed</span>
                            <span class="text-xs font-black text-rose-400 uppercase">Delegation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isDark = document.documentElement.classList.contains('dark');
            const textColor = isDark ? '#94a3b8' : '#64748b';
            const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

            const ctx = document.getElementById('skillRadarChart').getContext('2d');
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Decision Making', 'Leadership', 'Innovation', 'Discipline', 'Commitment', 'Delegation'],
                    datasets: [{
                        label: 'Current Status',
                        data: [88, 72, 94, 82, 85, 64],
                        fill: true,
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        borderColor: '#6366F1',
                        borderWidth: 3,
                        pointBackgroundColor: '#6366F1',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#6366F1'
                    }, {
                        label: 'Organization Peak',
                        data: [92, 88, 90, 95, 92, 85],
                        fill: true,
                        backgroundColor: 'rgba(168, 85, 247, 0.1)',
                        borderColor: 'rgba(168, 85, 247, 0.4)',
                        borderWidth: 2,
                        pointRadius: 0
                    }]
                },
                options: {
                    interaction: { mode: 'index', intersect: false },
                    elements: { line: { tension: 0.1 } },
                    plugins: { 
                        legend: { 
                            position: 'bottom', 
                            labels: { 
                                boxWidth: 10, 
                                font: { size: 10, weight: 'bold' },
                                color: textColor,
                                padding: 20
                            } 
                        },
                        tooltip: {
                            backgroundColor: isDark ? 'rgba(24, 24, 27, 0.8)' : 'rgba(255, 255, 255, 0.8)',
                            titleColor: isDark ? '#fff' : '#000',
                            bodyColor: isDark ? '#d4d4d8' : '#3f3f46',
                            borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6,
                            usePointStyle: true,
                            bodyFont: { family: 'Outfit', size: 12 },
                            titleFont: { family: 'Outfit', size: 13, weight: 'bold' }
                        }
                    },
                    scales: {
                        r: {
                            angleLines: { color: gridColor },
                            grid: { color: gridColor },
                            pointLabels: { font: { size: 9, weight: 'bold' }, color: textColor },
                            ticks: { display: false },
                            suggestedMin: 50,
                            suggestedMax: 100
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 2000, easing: 'easeOutQuart' }
                }
            });
        });
    </script>
</x-app-layout>
