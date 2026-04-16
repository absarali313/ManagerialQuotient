<x-app-layout>
    <div class="space-y-10 pb-12">
        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 py-4">
            <div class="space-y-2">
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900">
                    Precision Intelligence,<br/>
                    <span class="text-slate-500">{{ Auth::user()->name }}.</span>
                </h1>
                <p class="text-slate-500 font-medium">Your managerial performance is currently <span class="text-blue-600 font-bold">Trending Upwards</span>.</p>
            </div>
            
            <!-- Current MQ Score Card -->
            <div class="glass-card w-full md:w-96 !p-8 relative overflow-hidden group bg-white border border-slate-200 shadow-sm">
                <div class="flex justify-between items-start mb-6">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Personal MQ Index</span>
                    <span class="mq-badge bg-blue-50 text-blue-700 border border-blue-200">Tier 1 Elite</span>
                </div>
                <div class="flex items-end gap-3 mb-6">
                    <span class="text-6xl font-black text-slate-900 tracking-tight">87.5</span>
                    <div class="mb-2">
                        <span class="text-xs font-bold text-emerald-600 flex items-center gap-1 bg-emerald-50 px-2 py-1 rounded border border-emerald-100">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                            +4.2
                        </span>
                    </div>
                </div>
                <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-full rounded-full transition-all duration-1000 shadow-sm" style="width: 87.5%"></div>
                </div>
                <div class="mt-4 flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                    <span>Baseline: 72.0</span>
                    <span>Global Avg: 68.4</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-8">
            <div class="lg:col-span-3 space-y-8">
                <!-- Action Center -->
                <div class="glass-card flex flex-col h-full !p-0 overflow-hidden bg-white border border-slate-200 shadow-sm">
                    <div class="p-8 border-b border-slate-200 flex justify-between items-center bg-slate-50">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                                Action Center
                            </h3>
                            <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-1">Intelligence-based Priorities</p>
                        </div>
                        <span class="mq-badge bg-rose-50 text-rose-700 border border-rose-200">3 Urgent</span>
                    </div>
                    
                    <div class="divide-y divide-slate-100">
                        <!-- Assessment Task -->
                        <div class="p-8 flex items-center justify-between hover:bg-slate-50 transition-all group">
                            <div class="flex gap-5">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-bold text-slate-900">Continuum Assessment: Cycle 04</p>
                                    <p class="text-xs text-slate-500 font-medium">Evaluation of "Strategic Delegation" skills required.</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="mq-badge bg-blue-100 text-blue-700 border border-blue-200 !text-[8.5px]">Due in 4h</span>
                                        <span class="text-[9px] font-bold text-blue-500 uppercase">Estimated time: 12 min</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('assessment') }}" class="mq-button-primary !py-2 !px-5 !text-[10px] uppercase tracking-widest hover:shadow-md">Initialize</a>
                        </div>
                        
                        <!-- Feedback Task -->
                        <div class="p-8 flex items-center justify-between hover:bg-slate-50 transition-all group">
                            <div class="flex gap-5">
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-100 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-sm font-bold text-slate-900">Team Qualitative Analysis</p>
                                    <p class="text-xs text-slate-500 font-medium">3 team members requesting feedback synchronization.</p>
                                </div>
                            </div>
                            <button class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-[10px] font-bold text-slate-700 hover:bg-slate-50 transition-all shadow-sm uppercase tracking-widest">Execute</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skill Growth Radar -->
            <div class="lg:col-span-2 glass-card flex flex-col h-full relative overflow-hidden bg-white border border-slate-200 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Competency Mapping</h3>
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-1">Multi-dimensional Analysis</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                </div>

                <div class="flex-1 flex flex-col items-center justify-center space-y-10 py-4">
                    <div class="w-full aspect-square max-w-[320px] relative">
                        <canvas id="skillRadarChart"></canvas>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-[9px] font-bold text-slate-500 uppercase block mb-1">Strongest Pillar</span>
                            <span class="text-xs font-black text-emerald-600 uppercase">Innovation</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-[9px] font-bold text-slate-500 uppercase block mb-1">Growth Needed</span>
                            <span class="text-xs font-black text-rose-500 uppercase">Delegation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textColor = '#475569';
            const gridColor = '#f1f5f9';
            const isDark = false;

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
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgba(59, 130, 246, 0.4)',
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
