<x-ui.card>
    <div class="flex justify-between items-start mb-8">
        <div>
            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Performance Timeline</h2>
            <p class="text-sm text-gray-400 mt-1">Your MQ score progression over the selected period</p>
        </div>
        <div class="flex bg-gray-50 border border-gray-100 p-1 rounded-xl gap-1">
            @foreach($ranges as $val => $label)
                <button
                    wire:click="setMonths('{{ $val }}')"
                    class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all {{ $months === $val ? 'bg-white shadow-sm text-gray-900' : 'text-gray-400 hover:text-gray-600' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="relative w-full" style="height: 260px;">
        <svg class="w-full h-full" viewBox="0 0 800 240" preserveAspectRatio="none">
            <defs>
                <linearGradient id="empChartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.18" />
                    <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:0" />
                </linearGradient>
            </defs>

            @php
                $yMin = 50; $yMax = 100;
                $chartTop = 10; $chartBottom = 220;
                $chartH = $chartBottom - $chartTop;
                $chartLeft = 40; $chartRight = 780;
                $chartW = $chartRight - $chartLeft;
                $count = count($points);
            @endphp

            {{-- Y-axis grid lines --}}
            @foreach([50, 60, 70, 80, 90, 100] as $yVal)
                @php $yPx = $chartBottom - (($yVal - $yMin) / ($yMax - $yMin)) * $chartH; @endphp
                <line x1="{{ $chartLeft }}" y1="{{ $yPx }}" x2="{{ $chartRight }}" y2="{{ $yPx }}"
                      stroke="#F3F4F6" stroke-width="1.5" />
                <text x="{{ $chartLeft - 8 }}" y="{{ $yPx + 4 }}"
                      font-size="10" font-weight="700" fill="#D1D5DB" text-anchor="end">{{ $yVal }}</text>
            @endforeach

            @if($count > 1)
                @php
                    $svgPoints = [];
                    foreach ($points as $i => $p) {
                        $x = $chartLeft + ($i / ($count - 1)) * $chartW;
                        $score = max($yMin, min($yMax, $p['score']));
                        $y = $chartBottom - (($score - $yMin) / ($yMax - $yMin)) * $chartH;
                        $svgPoints[] = ['x' => $x, 'y' => $y, 'score' => $score];
                    }
                    $pathD = "M {$svgPoints[0]['x']} {$svgPoints[0]['y']}";
                    for ($i = 1; $i < count($svgPoints); $i++) {
                        $cpx = ($svgPoints[$i-1]['x'] + $svgPoints[$i]['x']) / 2;
                        $pathD .= " C {$cpx} {$svgPoints[$i-1]['y']}, {$cpx} {$svgPoints[$i]['y']}, {$svgPoints[$i]['x']} {$svgPoints[$i]['y']}";
                    }
                    $lastPt = end($svgPoints);
                    $areaD = $pathD . " L {$lastPt['x']} {$chartBottom} L {$svgPoints[0]['x']} {$chartBottom} Z";
                @endphp

                <path d="{{ $areaD }}" fill="url(#empChartGradient)" />
                <path d="{{ $pathD }}" fill="none" stroke="#3B82F6" stroke-width="3"
                      stroke-linecap="round" stroke-linejoin="round"/>

                @foreach($svgPoints as $pt)
                    <g class="group" style="cursor:pointer">
                        <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="10" fill="transparent" />
                        <circle cx="{{ $pt['x'] }}" cy="{{ $pt['y'] }}" r="5" fill="white" stroke="#3B82F6" stroke-width="2.5" />
                        <g class="opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                            <rect x="{{ $pt['x'] - 22 }}" y="{{ $pt['y'] - 32 }}" width="44" height="20" rx="5" fill="#1F2937" />
                            <text x="{{ $pt['x'] }}" y="{{ $pt['y'] - 18 }}"
                                  font-size="11" font-weight="800" fill="white" text-anchor="middle">{{ $pt['score'] }}</text>
                        </g>
                    </g>
                @endforeach
            @else
                <text x="400" y="120" font-size="13" fill="#9CA3AF" text-anchor="middle" font-weight="600">
                    No data for this period
                </text>
            @endif
        </svg>

        {{-- X-axis labels --}}
        @if($count > 0)
            <div class="absolute bottom-0 left-0 right-0 flex justify-between text-[10px] font-bold text-gray-400"
                 style="padding-left: 40px; padding-right: 20px;">
                @foreach($labels as $label)
                    <span>{{ $label }}</span>
                @endforeach
            </div>
        @endif
    </div>
</x-ui.card>
