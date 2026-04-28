<div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-2">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Employee Rankings Leaderboard</h1>
        <p class="text-base text-gray-500 mt-1 font-medium">Track and compare performance across the organization.</p>
    </div>
    <div class="flex-col items-center gap-3 shrink-0">
        <div class="relative group inline-flex">
            <button wire:click="export" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all shadow-sm">
                <x-lucide-download class="w-4 h-4 text-gray-400" />
                Export
            </button>

            <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="bg-gray-800 text-white text-xs px-3 py-2 rounded-lg shadow-lg w-64">
                    Export respects current filters (search, department, period, score range)
                </div>
            </div>
        </div>
    </div>
</div>
