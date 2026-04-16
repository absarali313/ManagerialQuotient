<x-app-layout>
    <div x-data="{ showAddEmployeeModal: false }" class="space-y-10 pb-12">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                    Organization Intelligence
                </h2>
                <p class="text-slate-500 font-medium text-sm">Real-time performance metrics and AI-driven insights.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-all shadow-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Export Report
                </button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition-all shadow-sm">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create Assessment
                </button>
                <button class="mq-button-primary">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    New Cycle
                </button>
            </div>
        </div>

        @if(session('status'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-3 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="text-sm font-semibold">{{ session('status') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-3 rounded-2xl">
                <ul class="text-sm font-semibold list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <!-- Top Metrics Grid -->
        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Organization Health -->
            <div class="glass-card lg:col-span-1 flex flex-col items-center justify-center relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-16 h-16 text-indigo-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-zinc-500 uppercase tracking-widest mb-4">Health Index</h3>
                <div class="relative w-40 h-40">
                    <canvas id="healthScoreChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-black text-zinc-900 dark:text-zinc-100">88.4</span>
                        <span class="mq-badge mq-badge-primary mt-1">Excellent</span>
                    </div>
                </div>
            </div>

            <!-- KPI Radar Chart (New) -->
            <div class="glass-card lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Competency Breakdown</h3>
                    <div class="flex gap-2">
                        <span class="mq-badge bg-emerald-50 text-emerald-700 text-[9px] border border-emerald-200">Decision Making ↑ 12%</span>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="kpiRadarChart"></canvas>
                </div>
            </div>

            <!-- AI Insight Card -->
            <div class="glass-card lg:col-span-1 bg-blue-600 !text-white border-none shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-white/20 rounded-lg backdrop-blur-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-lg">AI Optimization</h3>
                </div>
                <p class="text-indigo-100 text-sm leading-relaxed mb-6">
                    Based on recent assessments, your engineering team is excelling in <span class="white font-bold underline">Decision Intelligence</span> but shows a minor gap in <span class="white font-bold underline">Delegation</span>.
                </p>
                <div class="space-y-3">
                    <div class="p-3 bg-white/10 rounded-xl border border-white/10 text-xs">
                        <span class="font-bold block mb-1 uppercase tracking-tighter opacity-70">Recommendation</span>
                        Schedule a "Leadership Foundations" module for Junior Managers.
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Section: Ranking and Timeline -->
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Talent Leaderboard (8.3) -->
            <div class="glass-card lg:col-span-1 !p-0 overflow-hidden">
                <div class="p-6 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Talent Leaderboard
                    </h3>
                    <span class="text-[10px] font-bold text-indigo-500 uppercase">Top 10%</span>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach($users->take(4) as $index => $u)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-slate-300 w-4">{{ $index + 1 }}</span>
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-700 shadow-sm">
                                {{ strtoupper(substr($u->name, 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-900">{{ $u->name }}</h4>
                                <span class="text-[10px] text-slate-500 font-medium">Completed: <span class="text-blue-600">{{ $u->assessments->where('status', 'completed')->count() }}</span></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold text-emerald-600">
                                Active
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="p-4 bg-zinc-50 dark:bg-zinc-900/50 text-center">
                    <button class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-widest transition-colors">View All Metrics</button>
                </div>
            </div>

            <!-- Performance Timeline (5.4) -->
            <div class="glass-card lg:col-span-2">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Performance Timeline</h3>
                        <p class="text-xs text-zinc-500">Historical trend analysis over 12 months</p>
                    </div>
                    <select class="bg-zinc-50 dark:bg-zinc-800 border-none text-[10px] font-bold rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option>Last 12 Months</option>
                        <option>Last 6 Months</option>
                        <option>Year to Date</option>
                    </select>
                </div>
                <div class="h-64">
                    <canvas id="performanceTimelineChart"></canvas>
                </div>
            </div>
        </div>

        <!-- User Management Table (Updated) -->
        <div class="glass-card !p-0 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                <h3 class="text-lg font-bold text-slate-900">Personnel Management</h3>
                <div class="flex gap-2">
                    <div class="relative">
                        <input type="text" placeholder="Search team..." class="bg-white border border-slate-200 rounded-lg px-4 py-2 text-xs focus:ring-2 focus:ring-blue-500 w-64 transition-all">
                    </div>
                    <button @click="showAddEmployeeModal = true" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-sm font-bold hover:bg-slate-800 transition-all shadow-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Employee
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white text-slate-500 text-[10px] font-bold uppercase tracking-widest border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">User Details</th>
                            <th class="px-6 py-4 text-center">Total Assessments</th>
                            <th class="px-6 py-4">Current Status</th>
                            <th class="px-6 py-4">Assessment Validation</th>
                            <th class="px-6 py-4">Joined At</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $u)
                        <tr class="hover:bg-slate-50 transition-colors text-sm group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-900">{{ $u->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-medium">{{ $u->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs text-center">
                                <span class="font-bold text-slate-700">{{ $u->assessments->count() }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-blue-600">{{ $u->assessments->where('status', 'completed')->count() > 0 ? 'Active' : 'Unassessed' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($u->assessments->where('status', 'completed')->count() > 0)
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        Certified
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-700 border border-amber-200">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-[11px] font-medium">{{ $u->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md text-[10px] font-bold uppercase tracking-widest border border-blue-200 transition-all flex items-center">
                                        Assign
                                    </button>
                                    @if($u->assessments->where('status', 'completed')->count() > 0)
                                        <button class="px-3 py-1.5 bg-white text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-[10px] font-bold uppercase tracking-widest border border-slate-200 transition-all shadow-sm">
                                            Report
                                        </button>
                                    @else
                                        <button class="px-3 py-1.5 text-slate-400 rounded-md text-[10px] font-bold uppercase tracking-widest border border-transparent cursor-not-allowed opacity-50">
                                            Report
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textColor = '#475569';
            const gridColor = '#f1f5f9';
            const isDark = false;

            // Health Score Chart
            new Chart(document.getElementById('healthScoreChart'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [88.4, 11.6],
                        backgroundColor: ['#6366F1', isDark ? '#1e1e2d' : '#f1f5f9'],
                        borderWidth: 0,
                        circumference: 270,
                        rotation: 225,
                        borderRadius: 20,
                    }]
                },
                options: {
                    cutout: '82%',
                    plugins: { legend: { display: false }, tooltip: { enabled: false } },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Radar Chart for KPIs
            new Chart(document.getElementById('kpiRadarChart'), {
                type: 'radar',
                data: {
                    labels: ['Decision Making', 'Communication', 'Leadership', 'Innovation', 'Discipline', 'Commitment'],
                    datasets: [{
                        label: 'Organization Average',
                        data: [85, 90, 78, 88, 82, 92],
                        fill: true,
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        borderColor: '#6366F1',
                        pointBackgroundColor: '#6366F1',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#6366F1'
                    }, {
                        label: 'Standard Benchmark',
                        data: [75, 80, 75, 70, 80, 85],
                        fill: true,
                        backgroundColor: 'rgba(168, 85, 247, 0.1)',
                        borderColor: 'rgba(168, 85, 247, 0.5)',
                        pointBackgroundColor: 'rgba(168, 85, 247, 1)',
                        pointBorderColor: '#fff',
                    }]
                },
                options: {
                    elements: { line: { borderWidth: 2 } },
                    scales: {
                        r: {
                            angleLines: { color: gridColor },
                            grid: { color: gridColor },
                            pointLabels: { font: { size: 10, weight: 'bold' }, color: textColor },
                            ticks: { display: false },
                            suggestedMin: 50,
                            suggestedMax: 100
                        }
                    },
                    interaction: { mode: 'index', intersect: false },
                    plugins: { 
                        legend: { 
                            position: 'bottom',
                            labels: { boxWidth: 12, padding: 20, font: { size: 11, weight: 'bold' }, color: textColor }
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
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 2000, easing: 'easeOutQuart' }
                }
            });

            // Performance Timeline Chart
            new Chart(document.getElementById('performanceTimelineChart'), {
                type: 'line',
                data: {
                    labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
                    datasets: [{
                        label: 'Average MQ',
                        data: [76, 78, 77, 79, 81, 80, 83, 85, 84, 86, 87, 88],
                        fill: true,
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                            gradient.addColorStop(0, 'rgba(99, 102, 241, 0)');
                            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.15)');
                            return gradient;
                        },
                        borderColor: '#6366F1',
                        borderWidth: 3,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#6366F1',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2,
                    }]
                },
                options: {
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: isDark ? 'rgba(24, 24, 27, 0.8)' : 'rgba(255, 255, 255, 0.8)',
                            titleColor: isDark ? '#fff' : '#000',
                            bodyColor: isDark ? '#d4d4d8' : '#3f3f46',
                            borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)',
                            borderWidth: 1,
                            padding: 12,
                            usePointStyle: true,
                            bodyFont: { family: 'Outfit', size: 12 },
                            titleFont: { family: 'Outfit', size: 13, weight: 'bold' }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: false, 
                            min: 70,
                            grid: { color: gridColor, drawBorder: false },
                            ticks: { color: textColor, font: { size: 10 } }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { color: textColor, font: { size: 10 } }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' },
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 2000, easing: 'easeOutQuart' }
                }
            });
        });
    </script>

    <!-- Add Employee Modal -->
    <div x-show="showAddEmployeeModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" style="display:none;">
        <div x-show="showAddEmployeeModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="showAddEmployeeModal = false" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
        <div x-show="showAddEmployeeModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-white rounded-3xl shadow-xl w-full max-w-md mx-4 border border-slate-200 z-50">
            <form action="{{ route('add-employee') }}" method="POST">
                @csrf
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Invite New Employee</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Account tied to your company profile.</p>
                        </div>
                        <button type="button" @click="showAddEmployeeModal = false" class="ml-auto p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-1.5">Full Name</label>
                            <input type="text" name="name" required placeholder="e.g. Sarah Johnson" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-3 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-1.5">Work Email</label>
                            <input type="email" name="email" required placeholder="sarah@company.com" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-3 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-1.5">Temporary Password</label>
                            <input type="password" name="password" required minlength="8" placeholder="Min. 8 characters" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block p-3 transition-all">
                            <p class="text-[10px] text-slate-400 mt-1.5 font-medium">Employee should change this on first login.</p>
                        </div>
                    </div>
                </div>
                <div class="px-8 pb-8 flex gap-3">
                    <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition-all shadow-sm">Add Employee</button>
                    <button type="button" @click="showAddEmployeeModal = false" class="flex-1 py-3 bg-slate-100 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-200 transition-all">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

