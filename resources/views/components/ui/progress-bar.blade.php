@props([
    'value' => 0,
    'label' => '',
    'teamAvg' => null,
    'color' => 'bg-green-500'
])

<div class="space-y-1">
    <div class="flex justify-between items-end">
        <span class="text-[14px] font-bold text-gray-800 tracking-tight">{{ $label }}</span>
        <div class="flex items-baseline gap-1">
            <span class="text-sm font-bold text-gray-900">{{ $value }}</span>
            <span class="text-[10px] text-gray-400 font-bold">/100</span>
        </div>
    </div>
    
    <div class="relative pt-1">
        <div class="overflow-hidden h-1.5 text-xs flex rounded-full bg-gray-100">
            <div style="width: {{ $value }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center {{ $color }} transition-all duration-1000"></div>
        </div>
        
        @if($teamAvg)
            <div class="mt-1 flex justify-between items-center opacity-60">
                <div class="relative w-full">
                    <div style="left: {{ $teamAvg }}%" class="absolute -top-2 flex flex-col items-center">
                         <div class="w-px h-2 bg-gray-300"></div>
                    </div>
                </div>
                <span class="text-[9px] text-gray-400 font-bold tabular-nums ml-auto">Team Avg: {{ $teamAvg }}</span>
            </div>
        @endif
    </div>
</div>
