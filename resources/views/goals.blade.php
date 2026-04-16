<x-app-layout>
    <div class="space-y-12 pb-12">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                    Strategic Objectives
                </h2>
                <p class="text-slate-500 font-medium">Tracking organizational and personal OKRs with real-time accuracy.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="mq-button-primary !py-2.5 !text-[10px] uppercase tracking-widest hover:shadow-md">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create New Goal
                </button>
            </div>
        </div>

        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Sidebar Metrics -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-card flex flex-col items-center text-center !p-8 border-slate-200 shadow-sm bg-white">
                    <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-6">Aggregate Velocity</h3>
                    <div class="relative w-32 h-32 mb-6">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <circle class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                            <circle class="text-blue-600 shadow-sm" stroke-width="3" stroke-dasharray="72, 100" stroke-linecap="round" stroke="currentColor" fill="none" cx="18" cy="18" r="16" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-black text-slate-900">72%</span>
                        </div>
                    </div>
                    <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-tight">On Track for Q2</p>
                </div>

                <div class="glass-card !p-6 space-y-4 shadow-sm border-slate-200 bg-white">
                    <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Goal Distribution</h3>
                    <div class="space-y-3">
                        @foreach([
                            ['label' => 'Strategic', 'count' => 4, 'color' => 'bg-indigo-500'],
                            ['label' => 'Technical', 'count' => 6, 'color' => 'bg-purple-500'],
                            ['label' => 'Operational', 'count' => 3, 'color' => 'bg-emerald-500'],
                        ] as $dist)
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-600">{{ $dist['label'] }}</span>
                            <span class="font-black text-slate-900 text-xs">{{ $dist['count'] }}</span>
                        </div>
                        <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden">
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
                <div class="glass-card !p-0 overflow-hidden group hover:border-slate-300 bg-white border border-slate-200 transition-all shadow-sm hover:shadow-md">
                    <div class="p-8 border-b border-slate-200 bg-slate-50 flex justify-between items-start">
                        <div class="space-y-2">
                             <div class="flex items-center gap-3">
                                 <span class="mq-badge bg-{{ $goal['color'] }}-50 text-{{ $goal['color'] }}-700 border border-{{ $goal['color'] }}-200 group-hover:scale-105 transition-transform">{{ $goal['type'] }}</span>
                                 <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">DUE {{ $goal['due'] }}</span>
                             </div>
                             <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $goal['title'] }}</h3>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 hover:bg-slate-200 rounded-lg text-slate-400 hover:text-blue-600 transition-all opacity-0 group-hover:opacity-100 relative top-1 right-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-8 space-y-10">
                        @foreach($goal['krs'] as $kr)
                        <div class="space-y-4">
                            <div class="flex justify-between items-end">
                                <div class="space-y-1">
                                    <span class="text-xs font-bold text-slate-900 uppercase tracking-tight">{{ $kr['name'] }}</span>
                                    <div class="flex items-center gap-2">
                                        @if($kr['trend'] === 'up')
                                            <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100 uppercase flex items-center gap-0.5">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                                                Trending ahead
                                            </span>
                                        @else
                                            <span class="text-[9px] font-bold text-rose-600 bg-rose-50 px-2 py-0.5 rounded border border-rose-100 uppercase flex items-center gap-0.5">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v3.586l-4.293-4.293a1 1 0 00-1.414 0L8 12.586l-4.293-4.293l-1.414 1.414l5 5a1 1 0 001.414 0L11 12.414l3.586 3.586H12z" clip-rule="evenodd"></path></svg>
                                                Attention needed
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-bold text-slate-900">{{ $kr['progress'] }}%</span>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $kr['current'] }} / {{ $kr['target'] }}</p>
                                </div>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden p-0.5">
                                <div class="bg-blue-600 h-full rounded-full transition-all duration-1000 shadow-sm" style="width: {{ $kr['progress'] }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="px-8 py-4 bg-slate-50 flex justify-between items-center border-t border-slate-100">
                        <div class="flex -space-x-2">
                            @foreach([1,2,3] as $i)
                                <div class="w-6 h-6 rounded-full border-2 border-white bg-slate-200 flex items-center justify-center text-[8px] font-bold text-slate-400">
                                    {{ $i }}
                                </div>
                            @endforeach
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-blue-600 flex items-center justify-center text-[8px] font-bold text-white shadow-sm">
                                +2
                            </div>
                        </div>
                        <button class="text-[9px] font-bold text-blue-500 uppercase tracking-widest hover:underline transition-all">Audit Threads</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
