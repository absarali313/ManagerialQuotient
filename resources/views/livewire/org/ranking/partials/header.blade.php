<div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-2">
    <div>
        <p class="text-xs font-semibold text-gray-400 mb-1 flex items-center gap-1.5">
            <a href="{{ route('org-employees') }}" class="hover:text-[#5D45FD]">Employees</a>
            <x-lucide-chevron-right class="w-3 h-3" />
            <span class="text-gray-600">Rankings Leaderboard</span>
        </p>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Employee Rankings Leaderboard</h1>
        <p class="text-base text-gray-500 mt-1 font-medium">Track and compare performance across the organization.</p>
    </div>
    <div class="flex items-center gap-3 shrink-0">
        <button class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all shadow-sm">
            <x-lucide-download class="w-4 h-4 text-gray-400" />
            Export
        </button>
    </div>
</div>
