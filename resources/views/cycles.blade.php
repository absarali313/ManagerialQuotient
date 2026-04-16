<x-app-layout>
    <div class="space-y-10 pb-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100 italic">
                    Cycle <span class="text-gradient">Control</span>
                </h2>
                <div class="flex items-center gap-3">
                    <span class="mq-badge bg-zinc-800 text-white !text-[9px]">Active Cycle</span>
                    <p class="text-zinc-500 font-medium text-sm">Annual Performance Review 2024</p>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="px-5 py-2.5 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl text-xs font-black uppercase tracking-widest text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 transition-all shadow-sm">View Archive</button>
                <button class="mq-button-primary !py-2.5 !text-[10px] uppercase tracking-widest">Adjust Timeline</button>
            </div>
        </div>

        <!-- Animated Stepper (5.2) -->
        <div class="glass-card !p-8 relative overflow-hidden">
             <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5 opacity-50"></div>
             <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                @foreach([
                    ['name' => 'Cycle Setup', 'status' => 'Certified', 'dates' => 'Jan 01 - Feb 15', 'active' => false, 'done' => true, 'icon' => 'M9 12l2 2 4-4'],
                    ['name' => 'Self-Assessment', 'status' => 'Ongoing', 'dates' => 'Feb 16 - Mar 15', 'active' => true, 'done' => false, 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['name' => 'Peer Review', 'status' => 'Queued', 'dates' => 'Mar 16 - Apr 15', 'active' => false, 'done' => false, 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                    ['name' => 'Managerial Audit', 'status' => 'Locked', 'dates' => 'Apr 16 - May 15', 'active' => false, 'done' => false, 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ] as $index => $step)
                    <div class="relative flex-1 group">
                        <div class="flex flex-col items-center text-center space-y-4 p-4 rounded-2xl transition-all duration-500 {{ $step['active'] ? 'bg-white dark:bg-zinc-800 shadow-2xl scale-110 ring-4 ring-indigo-500/10' : '' }}">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $step['done'] ? 'bg-emerald-500 text-white' : ($step['active'] ? 'bg-indigo-600 text-white' : 'bg-zinc-100 dark:bg-zinc-900 text-zinc-400') }} transition-all shadow-lg shadow-indigo-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-black text-zinc-900 dark:text-zinc-100 uppercase tracking-tighter">{{ $step['name'] }}</h4>
                                <p class="text-[9px] font-bold {{ $step['active'] ? 'text-indigo-500' : ($step['done'] ? 'text-emerald-500' : 'text-zinc-400') }} uppercase mt-0.5">{{ $step['status'] }}</p>
                                <p class="text-[8px] text-zinc-400 font-medium mt-1">{{ $step['dates'] }}</p>
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="hidden md:block flex-1 h-0.5 mx-4 border-t-2 border-dashed border-zinc-200 dark:border-zinc-800"></div>
                    @endif
                @endforeach
             </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Global Completion Radar -->
            <div class="glass-card lg:col-span-2 space-y-10">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 italic">Cycle Velocity</h3>
                        <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mt-1">Real-time throughput analysis</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-indigo-500 uppercase">Live Stream</span>
                    </div>
                </div>
                
                <div class="space-y-10">
                    <!-- Self Assessments -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-black text-zinc-900 dark:text-zinc-100 uppercase tracking-tighter">Self-Governance Assessments</span>
                            <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 dark:bg-indigo-900/30 px-2 py-0.5 rounded">85/100 DEPLOYED</span>
                        </div>
                        <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-3 rounded-full overflow-hidden shadow-inner flex">
                            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 h-full w-[85%] rounded-full shadow-[0_0_8px_rgba(99,102,241,0.4)]"></div>
                        </div>
                    </div>

                    <!-- Peer Reviews -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-black text-zinc-900 dark:text-zinc-100 uppercase tracking-tighter">Peer Intelligence Feed</span>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded">62/100 SYNCHRONIZED</span>
                        </div>
                        <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-3 rounded-full overflow-hidden shadow-inner">
                            <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-full w-[62%] rounded-full shadow-[0_0_8px_rgba(16,185,129,0.4)]"></div>
                        </div>
                    </div>

                    <!-- Managerial Audit -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-black text-zinc-400 uppercase tracking-tighter">Executive Calibration</span>
                            <span class="text-[10px] font-bold text-zinc-400 bg-zinc-50 dark:bg-zinc-900 px-2 py-0.5 rounded">PENDING DEPLOYMENT</span>
                        </div>
                        <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-3 rounded-full overflow-hidden shadow-inner"></div>
                    </div>
                </div>
                
                <div class="p-6 bg-indigo-500 text-white rounded-2xl shadow-xl shadow-indigo-500/20 relative overflow-hidden group border-none">
                    <div class="absolute right-0 top-0 p-8 opacity-10 group-hover:scale-150 transition-transform">
                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div class="space-y-2">
                             <h4 class="font-black text-lg italic tracking-tight uppercase tracking-widest">AI Performance Alert</h4>
                             <p class="text-xs text-indigo-100 max-w-sm">
                                System detected a bottleneck in <span class="white underline font-bold">Marketing</span>. 8 assessments are nearing overdue status.
                             </p>
                        </div>
                        <button class="bg-white text-indigo-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg hover:scale-105 transition-transform">Auto-Remind</button>
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
        <div class="glass-card !p-0 overflow-hidden border border-zinc-200 dark:border-zinc-800 shadow-2xl">
            <div class="p-8 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-black text-zinc-900 dark:text-zinc-100 italic">Personnel Synchronization Matrix</h3>
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mt-1">Cross-departmental calibration ledger</p>
                </div>
                <button class="mq-button-primary !py-2 !text-[9px] uppercase tracking-widest">Recalibrate All</button>
            </div>
            <div class="overflow-x-auto overflow-visible">
                 <table class="w-full text-left">
                    <thead class="bg-zinc-50/50 dark:bg-zinc-900/50 text-zinc-500 text-[9px] font-black uppercase tracking-[0.2em] border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-8 py-5">Unit Detail</th>
                            <th class="px-8 py-5">Sector</th>
                            <th class="px-8 py-5">Self-Governance</th>
                            <th class="px-8 py-5">Neural Peer Feed</th>
                            <th class="px-8 py-5">Admin Status</th>
                            <th class="px-8 py-5 text-right">Synchronization</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @foreach([
                            ['name' => 'Alexandra Kim', 'dept' => 'Product Intelligence', 'self' => 100, 'peer' => 85, 'status' => 'Synced', 'color' => 'emerald'],
                            ['name' => 'Mark Davidson', 'dept' => 'Viral Marketing', 'self' => 42, 'peer' => 12, 'status' => 'Desync', 'color' => 'rose'],
                            ['name' => 'Emily Chen', 'dept' => 'Neural Engineering', 'self' => 88, 'peer' => 74, 'status' => 'Calibrated', 'color' => 'indigo'],
                            ['name' => 'Sarah Jenkins', 'dept' => 'Core Product', 'self' => 100, 'peer' => 96, 'status' => 'Synced', 'color' => 'emerald'],
                        ] as $m)
                        <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-all text-xs group">
                            <td class="px-8 py-6 font-black text-zinc-900 dark:text-zinc-100">{{ $m['name'] }}</td>
                            <td class="px-8 py-6 text-zinc-500 font-bold uppercase tracking-tighter">{{ $m['dept'] }}</td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-1.5 w-24">
                                     <div class="flex justify-between text-[8px] font-black text-zinc-400 uppercase"><span>Active</span><span>{{ $m['self'] }}%</span></div>
                                     <div class="h-1 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                         <div class="bg-indigo-500 h-full transition-all duration-1000" style="width: {{ $m['self'] }}%"></div>
                                     </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-1.5 w-24">
                                     <div class="flex justify-between text-[8px] font-black text-zinc-400 uppercase"><span>Active</span><span>{{ $m['peer'] }}%</span></div>
                                     <div class="h-1 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                         <div class="bg-purple-500 h-full transition-all duration-1000" style="width: {{ $m['peer'] }}%"></div>
                                     </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="mq-badge {{ $m['color'] === 'emerald' ? 'bg-emerald-100 text-emerald-700' : ($m['color'] === 'rose' ? 'bg-rose-100 text-rose-700' : 'bg-indigo-100 text-indigo-700') }} !text-[8.5px] italic">
                                    {{ $m['status'] }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button class="text-indigo-600 font-black uppercase text-[10px] tracking-widest hover:underline transition-all">Audit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                 </table>
            </div>
        </div>
    </div>
</x-app-layout>
