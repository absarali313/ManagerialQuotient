<tr>
    <td colspan="8" class="px-6 py-16 text-center">
        <div class="flex flex-col items-center gap-3">
            <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center">
                <x-lucide-users class="w-6 h-6 text-gray-400" />
            </div>
            <p class="text-sm font-bold text-gray-500">No employees found</p>
            <p class="text-xs text-gray-400 font-medium">Try adjusting your search or filters</p>
            @if ($search || $department)
                <button wire:click="resetFilters" class="text-xs font-bold text-[#5D45FD] hover:underline">
                    Clear filters
                </button>
            @endif
        </div>
    </td>
</tr>
