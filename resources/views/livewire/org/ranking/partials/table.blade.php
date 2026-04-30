<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden pb-2">
    <table class="w-full text-left">
        <thead>
        <tr class="border-b border-gray-100">
            <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest w-20">Rank</th>
            <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Employee</th>
            <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Department</th>
            <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Performance Score</th>
            <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Trend</th>
            <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
        @forelse($ranked as $index => $employee)
            @include('livewire.org.ranking.partials.row')
        @empty
            <tr>
                <td colspan="6" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center">
                            <x-lucide-users class="w-6 h-6 text-gray-400" />
                        </div>
                        <p class="text-sm font-bold text-gray-500">No employees found</p>
                        <p class="text-xs text-gray-400 font-medium">Try adjusting your search or filters</p>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Include Pagination --}}
    @include('livewire.org.ranking.partials.pagination')
</div>
