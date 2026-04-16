<x-app-layout>
    <div class="space-y-10 pb-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                    Cycle Control
                </h2>
                <div class="flex items-center gap-3">
                    <span class="mq-badge bg-blue-100 text-blue-700 !text-[9px]">Active Cycle</span>
                    <p class="text-slate-500 font-medium text-sm">Annual Performance Review 2024</p>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold uppercase tracking-widest text-slate-600 hover:bg-slate-50 transition-all shadow-sm">View Archive</button>
                <button class="mq-button-primary !py-2.5 !text-[10px] uppercase tracking-widest">Adjust Timeline</button>
            </div>
        </div>

        <!-- Animated Stepper (5.2) -->
        <div class="glass-card !p-8 relative overflow-hidden bg-white shadow-sm border border-slate-200">
             <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                @foreach([
                    ['name' => 'Cycle Setup', 'status' => 'Certified', 'dates' => 'Jan 01 - Feb 15', 'active' => false, 'done' => true, 'icon' => 'M9 12l2 2 4-4'],
                    ['name' => 'Self-Assessment', 'status' => 'Ongoing', 'dates' => 'Feb 16 - Mar 15', 'active' => true, 'done' => false, 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['name' => 'Peer Review', 'status' => 'Queued', 'dates' => 'Mar 16 - Apr 15', 'active' => false, 'done' => false, 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                    ['name' => 'Managerial Audit', 'status' => 'Locked', 'dates' => 'Apr 16 - May 15', 'active' => false, 'done' => false, 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ] as $index => $step)
                    <div class="relative flex-1 group">
                        <div class="flex flex-col items-center text-center space-y-4 p-4 rounded-xl transition-all duration-500 {{ $step['active'] ? 'bg-slate-50 shadow-md scale-105 ring-2 ring-blue-500/20' : '' }}">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center {{ $step['done'] ? 'bg-emerald-100 text-emerald-600' : ($step['active'] ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-400') }} transition-all shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 uppercase tracking-tight">{{ $step['name'] }}</h4>
                                <p class="text-[10px] font-semibold {{ $step['active'] ? 'text-blue-600' : ($step['done'] ? 'text-emerald-500' : 'text-slate-400') }} uppercase mt-0.5">{{ $step['status'] }}</p>
                                <p class="text-[9px] text-slate-500 font-medium mt-1">{{ $step['dates'] }}</p>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="hidden md:block flex-1 h-0.5 mx-4 border-t-2 border-dashed border-slate-200"></div>
                    @endif
                @endforeach
             </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Global Completion Radar -->
            <div class="glass-card lg:col-span-2 space-y-10 border border-slate-200 shadow-sm bg-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Cycle Velocity</h3>
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-1">Real-time throughput analysis</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-bold text-blue-500 uppercase">Live Stream</span>
                    </div>
                </div>
                
                <div class="space-y-10">
                    <!-- Self Assessments -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-bold text-slate-900 uppercase tracking-tight">Self-Governance Assessments</span>
                            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">85/100 DEPLOYED</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden flex">
                            <div class="bg-blue-600 h-full w-[85%] rounded-full shadow-sm"></div>
                        </div>
                    </div>

                    <!-- Peer Reviews -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-bold text-slate-900 uppercase tracking-tight">Peer Intelligence Feed</span>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">62/100 SYNCHRONIZED</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-emerald-500 h-full w-[62%] rounded-full shadow-sm"></div>
                        </div>
                    </div>

                    <!-- Managerial Audit -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-tight">Executive Calibration</span>
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-50 border border-slate-200 px-2 py-0.5 rounded">PENDING DEPLOYMENT</span>
                        </div>
                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden"></div>
                    </div>
                </div>
                
                <div class="p-6 bg-blue-600 text-white rounded-xl shadow-lg relative overflow-hidden group border-none">
                    <div class="absolute right-0 top-0 p-8 opacity-10 group-hover:scale-150 transition-transform">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div class="space-y-2">
                             <h4 class="font-bold text-lg tracking-tight uppercase tracking-widest">System Update Alert</h4>
                             <p class="text-xs text-blue-100 max-w-sm">
                                System detected bottlenecks in recent evaluation metrics processing.
                             </p>
                        </div>
                        <button class="bg-white text-blue-600 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest shadow-sm hover:scale-105 transition-transform">Auto-Remind</button>
                    </div>
                </div>
            </div>

            <!-- Bottleneck Detector (5.6) -->
            <div class="glass-card bg-gradient-to-br from-rose-50 to-white dark:from-rose-900/10 dark:to-zinc-900 border-none relative overflow-hidden">
                <div class="absolute -right-4 -top-4 text-rose-500/5">
                    <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 16h2v2h-2v-2zm0-6h2v4h-2v-4z"/></svg>
                </div>
                <h3 class="text-xl font-black text-rose-900 dark:text-rose-100 italic mb-8 relative z-10">Neural Bottlenecks</h3>
                <div class="space-y-6 relative z-10">
                    @foreach([
                        ['name' => 'Mark Davidson', 'dept' => 'Marketing', 'count' => 8, 'severity' => 'Critical'],
                        ['name' => 'Emily Chen', 'dept' => 'Engineering', 'count' => 5, 'severity' => 'High'],
                        ['name' => 'David Lee', 'dept' => 'Sales', 'count' => 2, 'severity' => 'Moderate']
                    ] as $m)
                    <div class="p-5 rounded-2xl bg-white dark:bg-zinc-800 border-2 border-rose-100 dark:border-rose-900/30 shadow-sm group hover:scale-[1.02] transition-all">
                         <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center font-black">
                                    {{ substr($m['name'], 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-zinc-900 dark:text-zinc-100 uppercase">{{ $m['name'] }}</h4>
                                    <p class="text-[9px] font-bold text-zinc-400 uppercase">{{ $m['dept'] }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-black text-rose-600 uppercase">{{ $m['severity'] }}</span>
                         </div>
                         <div class="mt-4 flex items-center justify-between">
                            <span class="text-[10px] font-bold text-zinc-500 italic">{{ $m['count'] }} Overdue Threads</span>
                            <button class="text-rose-600 p-1 hover:bg-rose-50 rounded transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </button>
                         </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Personnel Logic Table -->
        <div class="glass-card !p-0 overflow-hidden border border-slate-200 shadow-sm bg-white">
            <div class="p-8 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Personnel Synchronization Matrix</h3>
                    <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-1">Cross-departmental calibration ledger</p>
                </div>
                <button class="mq-button-primary !py-2 !text-xs uppercase tracking-widest">Recalibrate All</button>
            </div>
            <div class="overflow-x-auto overflow-visible">
                 <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-500 text-[10px] font-bold uppercase tracking-widest border-b border-slate-200">
                        <tr>
                            <th class="px-8 py-5">User Account Detail</th>
                            <th class="px-8 py-5">Assessment History</th>
                            <th class="px-8 py-5">Completion Status</th>
                            <th class="px-8 py-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $m)
                        <tr class="hover:bg-slate-50/50 transition-all text-xs group">
                            <td class="px-8 py-6 font-semibold text-slate-900">{{ $m->name }}</td>
                            <td class="px-8 py-6 text-slate-500">{{ $m->assessments->count() }} assessments recorded.</td>
                            <td class="px-8 py-6">
                                <span class="mq-badge border {{ $m->assessments->where('status', 'completed')->count() > 0 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                    {{ $m->assessments->where('status', 'completed')->count() > 0 ? 'Completed' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="text-blue-600 font-bold uppercase text-[10px] tracking-widest hover:underline transition-all">Audit Record</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                 </table>
            </div>
        </div>
    </div>
</x-app-layout>
