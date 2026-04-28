<div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 px-6 py-4 border-b border-gray-100">

    {{-- Search --}}
    <div class="relative flex-1 w-full sm:max-w-xs">
        <x-lucide-search class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Search name or email…"
            class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition-all"
        />
    </div>

    {{-- Department filter --}}
    <select
        wire:model.live="department"
        class="text-sm bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-gray-700 font-semibold focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition-all"
    >
        <option value="">All Departments</option>
        @foreach ($departments as $dept)
            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
        @endforeach
    </select>

    {{-- Clear filters --}}
    @if ($search || $department)
        <button
            wire:click="resetFilters"
            class="flex items-center gap-1.5 text-xs font-bold text-gray-400 hover:text-red-500 transition-colors ml-auto sm:ml-0"
        >
            <x-lucide-x class="w-3.5 h-3.5" />
            Clear
        </button>
    @endif

    {{-- Result count --}}
    <p class="text-xs font-bold text-gray-400 ml-auto hidden sm:block">
        {{ $employees->total() }} {{ Str::plural('employee', $employees->total()) }}
    </p>
</div>
