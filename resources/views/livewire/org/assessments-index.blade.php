<div class="space-y-8">
    {{-- Header Section --}}
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold font-display text-gray-900 tracking-tight">Assessments</h1>
            <p class="text-gray-500 text-sm mt-1">Manage and assign performance evaluations</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="p-2.5 text-gray-400 hover:text-gray-600 bg-white border border-gray-100 rounded-xl shadow-sm transition-all hover:bg-gray-50 relative">
                <x-lucide-bell class="w-5 h-5" />
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
            </button>
            <button class="p-2.5 text-gray-400 hover:text-gray-600 bg-white border border-gray-100 rounded-xl shadow-sm transition-all hover:bg-gray-50">
                <x-lucide-mail class="w-5 h-5" />
            </button>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <x-lucide-clipboard-check class="w-6 h-6" />
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ App\Models\Assessment::where('organization_id', auth()->user()->organization_id)->count() }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Assignments</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <x-lucide-check-circle class="w-6 h-6" />
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ App\Models\Assessment::where('organization_id', auth()->user()->organization_id)->where('status', 'completed')->count() }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Completed</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <x-lucide-clock class="w-6 h-6" />
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ App\Models\Assessment::where('organization_id', auth()->user()->organization_id)->whereIn('status', ['pending', 'in_progress'])->count() }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Active</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <x-lucide-users class="w-6 h-6" />
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ App\Models\User::where('organization_id', auth()->user()->organization_id)->count() }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Org Size</p>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold font-display text-gray-900 tracking-tight">Active Assessments</h2>
                <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">{{ $assessments->total() }} Total</span>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <x-lucide-search class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" />
                    <input type="text" 
                           wire:model.live="search"
                           placeholder="Search evaluations..." 
                           class="pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 w-64 transition-all">
                </div>
                <button class="flex items-center gap-2 px-4 py-2 border border-gray-100 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                    <x-lucide-filter class="w-4 h-4" />
                    <span>Filter</span>
                </button>
                <button class="flex items-center gap-2 px-5 py-2 bg-[#5D45FD] text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-[#4C36E0] transition-all hover:-translate-y-0.5">
                    <x-lucide-plus class="w-4 h-4" />
                    <span>Deploy Assessment</span>
                </button>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="px-6 border-b border-gray-50 overflow-x-auto whitespace-nowrap scrollbar-hide">
            <div class="flex gap-8">
                @foreach($tabs as $tab)
                    <button wire:click="setTab('{{ $tab }}')" 
                            @class([
                                "py-4 text-sm font-bold transition-all relative",
                                "text-blue-600" => $activeTab === $tab,
                                "text-gray-400 hover:text-gray-600" => $activeTab !== $tab
                            ])>
                        {{ $tab }}
                        @if($activeTab === $tab)
                            <div class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 rounded-full"></div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest w-12 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                            Job Role / Assessment
                            <x-lucide-chevron-down class="w-3 h-3" />
                        </th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Assigned To</th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Questions</th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Duration</th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($assessments as $assessment)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-5 text-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center transition-transform group-hover:scale-105">
                                        <x-lucide-clipboard-list class="w-5 h-5" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 tracking-tight">{{ $assessment->jobRole?->title ?? 'General Assessment' }}</p>
                                        <p class="text-xs text-gray-400 font-medium">Evaluation Cycle: {{ $assessment->evaluationCycle?->name ?? 'None' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $firstKpi = $assessment->questions->first()?->kpi;
                                    $category = $firstKpi?->category ?? 'General';
                                @endphp
                                <span @class([
                                    "px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5",
                                    "bg-blue-100 text-blue-700" => $category === 'Technical',
                                    "bg-purple-100 text-purple-700" => $category === 'Soft Skills',
                                    "bg-emerald-100 text-emerald-700" => $category === 'Compliance',
                                    "bg-rose-100 text-rose-700" => $category === 'Leadership',
                                    "bg-gray-100 text-gray-700" => !in_array($category, ['Technical', 'Soft Skills', 'Compliance', 'Leadership'])
                                ])>
                                    <span @class([
                                        "w-1 h-1 rounded-full text-current bg-current opacity-70",
                                    ])></span>
                                    {{ $category }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex flex-col items-center">
                                    <p class="text-sm font-bold text-gray-900 tracking-tight">{{ $assessment->assignedTo?->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-tight">{{ $assessment->assignedTo?->department?->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm font-bold text-gray-700">{{ $assessment->questions_count ?? $assessment->questions->count() }}</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm font-bold text-gray-700">{{ $assessment->duration_minutes }}m</span>
                            </td>
                            <td class="px-6 py-5">
                                <span @class([
                                    "inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border",
                                    "bg-emerald-50 text-emerald-700 border-emerald-100" => $assessment->status === 'completed',
                                    "bg-blue-50 text-blue-700 border-blue-100" => $assessment->status === 'in_progress',
                                    "bg-amber-50 text-amber-700 border-amber-100" => $assessment->status === 'pending',
                                    "bg-rose-50 text-rose-700 border-rose-100" => $assessment->status === 'expired',
                                ])>
                                    <span @class([
                                        "w-1.5 h-1.5 rounded-full",
                                        "bg-emerald-500 animate-pulse" => $assessment->status === 'completed',
                                        "bg-blue-500" => $assessment->status === 'in_progress',
                                        "bg-amber-500" => $assessment->status === 'pending',
                                        "bg-rose-500" => $assessment->status === 'expired',
                                    ])></span>
                                    {{ str_replace('_', ' ', $assessment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="View Details">
                                        <x-lucide-eye class="w-4 h-4" />
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg transition-all" title="Manage Questions">
                                        <x-lucide-settings class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <x-lucide-search class="w-12 h-12 text-gray-200" />
                                    <p class="text-gray-500 font-medium">No assessments found matching your search.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/10">
            {{ $assessments->links() }}
        </div>
    </div>
</div>
