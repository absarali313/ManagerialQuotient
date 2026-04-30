@if ($sortBy === $column)
    @if ($sortDir === 'asc')
        <x-lucide-chevron-up class="w-3 h-3 text-[#5D45FD]" />
    @else
        <x-lucide-chevron-down class="w-3 h-3 text-[#5D45FD]" />
    @endif
@else
    <x-lucide-chevrons-up-down class="w-3 h-3 text-gray-300" />
@endif
