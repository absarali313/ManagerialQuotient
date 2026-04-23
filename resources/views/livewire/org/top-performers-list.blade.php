<x-ui.card class="flex-1 border-none shadow-sm h-full">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Top Performers</h2>
            <p class="text-sm font-medium text-gray-400 mt-0.5">Highest MQ scores this period</p>
        </div>
        <button wire:click="toggleShowAll" class="text-sm font-bold text-[#5D45FD] hover:underline">
            {{ $showAll ? 'Show Less' : 'View All' }}
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[11px] font-extrabold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                    <th class="pb-4 font-extrabold">Rank</th>
                    <th class="pb-4 font-extrabold">Employee</th>
                    <th class="pb-4 font-extrabold">Department</th>
                    <th class="pb-4 font-extrabold text-right">Score</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50/50">
                @foreach($performers as $index => $performer)
                    <tr class="group hover:bg-gray-50/50 transition-colors">
                        <td class="py-4">
                            @if($index < 3)
                                <div class="w-7 h-7 rounded-full flex items-center justify-center {{ $index === 0 ? 'bg-yellow-50 text-yellow-600' : ($index === 1 ? 'bg-blue-50 text-blue-500' : 'bg-orange-50 text-orange-500') }}">
                                    <x-lucide-trophy class="w-3.5 h-3.5" />
                                </div>
                            @else
                                <span class="text-sm font-extrabold text-gray-400 ml-2">{{ $index + 1 }}</span>
                            @endif
                        </td>
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/150?u={{ $performer->email }}" class="w-9 h-9 rounded-full border border-gray-100 shadow-sm" alt="">
                                <div>
                                    <p class="text-sm font-extrabold text-gray-900">{{ $performer->name }}</p>
                                    <p class="text-[11px] font-bold text-gray-400">{{ $performer->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4">
                            <span class="text-sm font-medium text-gray-500">{{ $performer->department->name ?? 'N/A' }}</span>
                        </td>
                        <td class="py-4 text-right">
                            <span class="text-sm font-extrabold text-gray-900">{{ number_format($performer->current_mq_score, 1) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-ui.card>
