<div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-4">
    <div class="flex flex-wrap items-center gap-3">
        <div class="relative flex-1 min-w-[220px]">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Filter employees..."
                class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 placeholder-gray-400 font-medium focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition"
            >
        </div>

        <select wire:model.live="department" class="text-sm border border-gray-200 rounded-xl bg-gray-50 pr-6 py-2 font-semibold text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition cursor-pointer">
            <option class="px-2" value="">All Departments</option>
            @foreach($departments as $dept)
                <option class="px-2" value="{{ $dept->id }}">{{ $dept->name }}</option>
            @endforeach
        </select>

        <select wire:model.live="period" class="text-sm border border-gray-200 rounded-xl bg-gray-50 pr-6 py-2 font-semibold text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition cursor-pointer">
            <option value="this_month">This Month</option>
            <option value="last_month">Last Month</option>
            <option value="this_quarter">This Quarter</option>
            <option value="this_year">This Year</option>
        </select>

        <select wire:model.live="scoreRange" class="text-sm border border-gray-200 rounded-xl bg-gray-50 pr-6 py-2 font-semibold text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition cursor-pointer">
            <option value="all">All Scores</option>
            <option value="high">High (80+)</option>
            <option value="mid">Mid (60–79)</option>
            <option value="low">Low (&lt;60)</option>
        </select>

        <div class="ml-auto flex items-center gap-1.5 text-sm font-semibold text-gray-500 shrink-0">
            <x-lucide-users class="w-4 h-4 text-gray-400" />
            {{ $totalCount }} employees
        </div>
    </div>
</div>
