@php
    $globalRank = ($ranked->currentPage() - 1) * $ranked->perPage() + $index + 1;
    $score      = $employee->current_mq_score ?? 0;
    $deptName   = $employee->department->name ?? 'N/A';

    $barWidth = min(100, $score);

    $barColor = match(true) {
        $score >= 90 => '#5D45FD',
        $score >= 75 => '#3B82F6',
        $score >= 60 => '#F59E0B',
        default      => '#EF4444',
    };

    $deptColors = [
        'Engineering' => ['bg-blue-50',   'text-blue-600'],
        'Product'     => ['bg-indigo-50', 'text-indigo-600'],
        'Marketing'   => ['bg-pink-50',   'text-pink-600'],
        'Sales'       => ['bg-green-50',  'text-green-600'],
        'Design'      => ['bg-orange-50', 'text-orange-600'],
        'Operations'  => ['bg-gray-100',  'text-gray-600'],
        'HR'          => ['bg-purple-50', 'text-purple-600'],
        'Finance'     => ['bg-teal-50',   'text-teal-600'],
    ];
    [$badgeBg, $badgeText] = $deptColors[$deptName] ?? ['bg-gray-100', 'text-gray-600'];

    $snapshot = $employee->latestPerformanceHistory;
    $trend    = $snapshot?->score_delta;
@endphp

<tr wire:key="{{ $employee->id }}" class="group hover:bg-gray-50/60 transition-colors">
    {{-- Rank --}}
    <td class="px-6 py-4">
        @if($globalRank === 1)
            <div class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center shadow-sm">
                <x-lucide-crown class="w-3.5 h-3.5 text-yellow-900" />
            </div>
        @elseif($globalRank === 2)
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                <span class="text-sm font-extrabold text-blue-600">2</span>
            </div>
        @elseif($globalRank === 3)
            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                <span class="text-sm font-extrabold text-orange-500">3</span>
            </div>
        @else
            <span class="text-sm font-extrabold text-gray-400 pl-2">{{ $globalRank }}</span>
        @endif
    </td>

    {{-- Employee --}}
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <img src="https://i.pravatar.cc/150?u={{ $employee->email }}" class="w-9 h-9 rounded-full border border-gray-100 shadow-sm object-cover shrink-0" alt="{{ $employee->name }}">
            <div>
                <p class="text-sm font-extrabold text-gray-900">{{ $employee->name }}</p>
                <p class="text-[11px] font-semibold text-gray-400">{{ $employee->jobRole->title ?? 'Employee' }}</p>
            </div>
        </div>
    </td>

    {{-- Department --}}
    <td class="px-6 py-4">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeBg }} {{ $badgeText }}">
            <span class="w-1.5 h-1.5 rounded-full bg-current inline-block"></span>
            {{ $deptName }}
        </span>
    </td>

    {{-- Performance Score --}}
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <div class="flex-1 max-w-[120px] bg-gray-100 rounded-full h-1.5">
                <div class="h-1.5 rounded-full transition-all" style="width: {{ $barWidth }}%; background-color: {{ $barColor }};"></div>
            </div>
            <span class="text-sm font-extrabold text-gray-900">{{ number_format($score, 0) }}</span>
        </div>
    </td>

    {{-- Trend --}}
    <td class="px-6 py-4">
        @if($trend === null)
            <span class="text-xs font-bold text-gray-300">— N/A</span>
        @elseif($trend > 0)
            <span class="flex items-center gap-1 text-green-600 text-xs font-bold">
                <x-lucide-trending-up class="w-3.5 h-3.5" />
                +{{ number_format($trend, 1) }}%
            </span>
        @elseif($trend < 0)
            <span class="flex items-center gap-1 text-red-500 text-xs font-bold">
                <x-lucide-trending-down class="w-3.5 h-3.5" />
                {{ number_format($trend, 1) }}%
            </span>
        @else
            <span class="text-xs font-bold text-gray-400">— 0.0%</span>
        @endif
    </td>

    {{-- Actions --}}
    <td class="px-6 py-4 text-center">
        <button class="px-4 py-1.5 rounded-xl text-xs font-bold border border-gray-200 text-gray-600 hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all">
            View Profile
        </button>
    </td>
</tr>
