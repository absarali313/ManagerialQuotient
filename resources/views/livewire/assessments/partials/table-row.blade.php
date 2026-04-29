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
    <td class="px-6 py-5 text-center">
        <div class="flex flex-col items-center">
            <p class="text-sm font-bold text-gray-900 tracking-tight">{{ $assessment->assignedTo?->name }}</p>
            <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-tight">{{ $assessment->assignedTo?->department?->name }}</p>
        </div>
    </td>
    <td class="px-6 py-5 text-center">
        <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
            L{{ $assessment->level }}
        </span>
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
            <button wire:click="deleteAssessment({{ $assessment->id }})" 
                    wire:confirm="Are you sure you want to delete this assessment?"
                    class="p-2 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete Assessment">
                <x-lucide-trash-2 class="w-4 h-4" />
            </button>
        </div>
    </td>
</tr>
