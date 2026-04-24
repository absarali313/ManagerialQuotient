<x-ui.card x-data="{ fullscreen: false }" :class="fullscreen ? 'fixed inset-0 z-[100] m-4 bg-white shadow-2xl rounded-3xl' : 'flex-1 border-none shadow-sm h-full overflow-hidden'">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Department Health</h2>
            <p class="text-sm font-medium text-gray-400 mt-0.5">Average scores by division</p>
        </div>
        <button @click="fullscreen = !fullscreen" class="p-1.5 text-gray-400 hover:text-gray-600 transition-colors relative z-10 bg-white rounded">
            <template x-if="!fullscreen">
                <x-lucide-maximize-2 class="w-5 h-5" />
            </template>
            <template x-if="fullscreen">
                <x-lucide-minimize-2 class="w-5 h-5" />
            </template>
        </button>
    </div>

    {{-- SVG Bar Chart --}}
    @php
        $barColors = ['#5D45FD', '#818CF8', '#F59E0B', '#10B981', '#EF4444'];
        $yMax = 100;
        $chartH = 200;
        $chartTop = 10;
        $chartBottom = $chartTop + $chartH;
        $chartLeft = 32;
        $chartRight = 320;
        $chartW = $chartRight - $chartLeft;
        $barCount = count($depts);
        $barWidth = 36;
        $gap = ($barCount > 0) ? ($chartW - $barCount * $barWidth) / ($barCount + 1) : 10;
    @endphp

    <div class="w-full">
        <svg class="w-full" viewBox="0 0 360 260" preserveAspectRatio="xMidYMid meet">
            {{-- Y-axis grid lines --}}
            @foreach([0, 20, 40, 60, 80] as $yVal)
                @php $yPx = $chartBottom - ($yVal / $yMax) * $chartH; @endphp
                <line x1="{{ $chartLeft }}" y1="{{ $yPx }}" x2="{{ $chartRight }}" y2="{{ $yPx }}"
                      stroke="#F3F4F6" stroke-width="1.5"/>
                <text x="{{ $chartLeft - 6 }}" y="{{ $yPx + 4 }}"
                      font-size="10" font-weight="700" fill="#D1D5DB" text-anchor="end">{{ $yVal }}</text>
            @endforeach

            {{-- Bars --}}
            @foreach($depts as $i => $dept)
                @php
                    $barX = $chartLeft + $gap + $i * ($barWidth + $gap);
                    $barH = max(4, ($dept['score'] / $yMax) * $chartH);
                    $barY = $chartBottom - $barH;
                    $color = $barColors[$i % count($barColors)];
                @endphp

                {{-- Bar --}}
                <rect x="{{ $barX }}" y="{{ $barY }}"
                      width="{{ $barWidth }}" height="{{ $barH }}"
                      fill="{{ $color }}" rx="5" ry="5" />

                {{-- Score label above bar --}}
                <text x="{{ $barX + $barWidth / 2 }}" y="{{ $barY - 5 }}"
                      font-size="10" font-weight="800" fill="#6B7280" text-anchor="middle">
                    {{ number_format($dept['score'], 0) }}
                </text>

                {{-- X-axis label --}}
                <text x="{{ $barX + $barWidth / 2 }}" y="{{ $chartBottom + 16 }}"
                      font-size="9.5" font-weight="700" fill="#9CA3AF" text-anchor="middle">
                    {{ Str::limit($dept['label'], 9, '') }}
                </text>
            @endforeach

            {{-- X-axis baseline --}}
            <line x1="{{ $chartLeft }}" y1="{{ $chartBottom }}" x2="{{ $chartRight }}" y2="{{ $chartBottom }}"
                  stroke="#E5E7EB" stroke-width="1.5"/>
        </svg>
    </div>
</x-ui.card>
