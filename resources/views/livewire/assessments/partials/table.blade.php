<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold font-display text-gray-900 tracking-tight">Active Assessments</h2>
            <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">{{ $assessments->total() }} Total</span>
        </div>
        
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-5 py-2 bg-[#5D45FD] text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-[#4C36E0] transition-all hover:-translate-y-0.5">
                <x-lucide-plus class="w-4 h-4" />
                <span>Create Assessment</span>
            </button>
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
                    <th class="px-8 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest flex items-center gap-2">
                        Assessment
                        <x-lucide-chevron-down class="w-3 h-3" />
                    </th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Assigned To</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Level</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Duration</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Status</th>
                    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($assessments as $assessment)
                    @include('livewire.assessments.partials.table-row', ['assessment' => $assessment])
                @empty
                    @include('livewire.assessments.partials.empty-state')
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/10">
        {{ $assessments->links() }}
    </div>
</div>
