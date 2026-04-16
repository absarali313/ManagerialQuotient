<x-app-layout>
    <div class="space-y-12 pb-12">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-zinc-100 italic">
                    Strategic <span class="text-gradient">Objectives</span>
                </h2>
                <p class="text-zinc-500 font-medium">Tracking organizational and personal OKRs with real-time accuracy.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="mq-button-primary !py-2.5 !text-[10px] uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create New Goal
                </button>
            </div>
        </div>

        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Sidebar Metrics -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-card flex flex-col items-center text-center !p-8 border-indigo-500/10">
                    <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-6">Aggregate Velocity</h3>
                    <div class="relative w-32 h-32 mb-6">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <circle class="text-zinc-100 dark:text-zinc-800" stroke-width="3" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                            <circle class="text-indigo-600 shadow-[0_0_10px_rgba(79,70,229,0.5)]" stroke-width="3" stroke-dasharray="72, 100" stroke-linecap="round" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-black text-zinc-900 dark:text-zinc-100">72%</span>
                        </div>
                    </div>
                    <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">On Track for Q2</p>
                </div>

                <div class="glass-card !p-6 space-y-4 shadow-sm border-zinc-100 dark:border-zinc-800">
                    <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Goal Distribution</h3>
                    <div class="space-y-3">
                        @foreach([
                            ['label' => 'Strategic', 'count' => 4, 'color' => 'bg-indigo-500'],
                            ['label' => 'Technical', 'count' => 6, 'color' => 'bg-purple-500'],
                            ['label' => 'Operational', 'count' => 3, 'color' => 'bg-emerald-500'],
                        ] as $dist)
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-zinc-600 dark:text-zinc-400">{{ $dist['label'] }}</span>
                            <span class="font-black text-zinc-900 dark:text-zinc-100 text-xs">{{ $dist['count'] }}</span>
                        </div>
                        <div class="w-full h-1 bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                            <div class="{{ $dist['color'] }} h-full" style="width: {{ ($dist['count'] / 13) * 100 }}%"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Objectives Timeline -->
            <div class="lg:col-span-3 space-y-8">
                @foreach([
                    ['title' => 'Optimize Performance Intelligence Infrastructure', 'due' => 'SEP 30, 2024', 'type' => 'Strategic', 'krs' => [
                        ['name' => 'Complete AI Neural Path Mapping', 'target' => '100%', 'current' => '85%', 'progress' => 85, 'trend' => 'up'],
                        ['name' => 'Integrate Real-time Feedback Stream', 'target' => '50ms Latency', 'current' => '120ms', 'progress' => 60, 'trend' => 'down']
                    ], 'color' => 'indigo'],
                    ['title' => 'Revolutionize User Navigation & UX Flow', 'due' => 'OCT 15, 2024', 'type' => 'Experience', 'krs' => [
                        ['name' => 'Deploy Glassmorphism V2 Components', 'target' => '42 Components', 'current' => '32', 'progress' => 76, 'trend' => 'up'],
                        ['name' => 'Conduct A/B testing with Tier-1 Groups', 'target' => '4 Teams', 'current' => '1', 'progress' => 25, 'trend' => 'up']
                    ], 'color' => 'purple']
                ] as $goal)
                <div class="glass-card !p-0 overflow-hidden group hover:border-{{ $goal['color'] }}-500/30 transition-all">
                    <div class="p-8 border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50/30 dark:bg-zinc-900/10 flex justify-between items-start">
                        <div class="space-y-2">
                             <div class="flex items-center gap-3">
                                 <span class="mq-badge bg-{{ $goal['color'] }}-100 text-{{ $goal['color'] }}-700 group-hover:scale-105 transition-transform">{{ $goal['type'] }}</span>
                                 <span class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.2em]">DUE {{ $goal['due'] }}</span>
                             </div>
                             <h3 class="text-2xl font-black text-zinc-900 dark:text-zinc-100 italic group-hover:text-indigo-600 transition-colors">{{ $goal['title'] }}</h3>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 hover:bg-white dark:hover:bg-zinc-800 rounded-lg text-zinc-400 hover:text-indigo-600 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-8 space-y-10">
                        @foreach($goal['krs'] as $kr)
                        <div class="space-y-4">
                            <div class="flex justify-between items-end">
                                <div class="space-y-1">
                                    <span class="text-xs font-black text-zinc-900 dark:text-zinc-100 uppercase tracking-tighter">{{ $kr['name'] }}</span>
                                    <div class="flex items-center gap-2">
                                        @if($kr['trend'] === 'up')
                                            <span class="text-[9px] font-bold text-emerald-500 uppercase flex items-center gap-0.5">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                                                Trending ahead
                                            </span>
                                        @else
                                            <span class="text-[9px] font-bold text-rose-500 uppercase flex items-center gap-0.5">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v3.586l-4.293-4.293a1 1 0 00-1.414 0L8 12.586l-4.293-4.293l-1.414 1.414l5 5a1 1 0 001.414 0L11 12.414l3.586 3.586H12z" clip-rule="evenodd"></path></svg>
                                                Attention needed
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-black text-zinc-900 dark:text-zinc-100">{{ $kr['progress'] }}%</span>
                                    <p class="text-[10px] font-bold text-zinc-400 uppercase">{{ $kr['current'] }} / {{ $kr['target'] }}</p>
                                </div>
                            </div>
                            <div class="w-full bg-zinc-100 dark:bg-zinc-800 h-2.5 rounded-full overflow-hidden shadow-inner p-0.5">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-full rounded-full transition-all duration-1000 shadow-[0_0_8px_rgba(99,102,241,0.3)]" style="width: {{ $kr['progress'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="px-8 py-4 bg-zinc-50 dark:bg-zinc-900/50 flex justify-between items-center">
                        <div class="flex -space-x-2">
                            @foreach([1,2,3] as $i)
                                <div class="w-6 h-6 rounded-full border-2 border-white dark:border-zinc-900 bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center text-[8px] font-black text-zinc-400">
                                    {{ $i }}
                                </div>
                            @endforeach
                            <div class="w-6 h-6 rounded-full border-2 border-white dark:border-zinc-900 bg-indigo-600 flex items-center justify-center text-[8px] font-black text-white">
                                +2
                            </div>
                        </div>
                        <button class="text-[9px] font-black text-indigo-500 uppercase tracking-widest hover:underline transition-all">Audit Threads</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
