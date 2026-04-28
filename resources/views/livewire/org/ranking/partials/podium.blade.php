@if($podium->count() >= 3)
    @php
        $first  = $podium->get(0);
        $second = $podium->get(1);
        $third  = $podium->get(2);

        $firstTrend  = $first?->latestPerformanceHistory?->score_delta;
        $secondTrend = $second?->latestPerformanceHistory?->score_delta;
        $thirdTrend  = $third?->latestPerformanceHistory?->score_delta;
    @endphp

    <div class="grid grid-cols-3 gap-4">
        {{-- 2nd Place --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5 flex flex-col shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-sm font-extrabold text-blue-600 shrink-0">2</div>
                <img src="https://i.pravatar.cc/150?u={{ $second->email }}" class="w-12 h-12 rounded-full border-2 border-white shadow-sm object-cover" alt="{{ $second->name }}">

                <div class="flex-1 min-w-0">
                    <p class="text-base font-extrabold text-gray-900 truncate">{{ $second->name }}</p>
                    <p class="text-xs font-medium text-gray-400 truncate">{{ $second->jobRole->title ?? 'Employee' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between mb-1.5">
                    @if($secondTrend === null)
                        <span class="text-xs font-bold text-gray-400">— N/A</span>
                    @elseif($secondTrend > 0)
                        <span class="flex items-center gap-1 text-green-500 text-xs font-bold">
                            <x-lucide-trending-up class="w-3.5 h-3.5" />
                            +{{ number_format($secondTrend, 1) }}%
                        </span>
                    @elseif($secondTrend < 0)
                        <span class="flex items-center gap-1 text-red-500 text-xs font-bold">
                            <x-lucide-trending-down class="w-3.5 h-3.5" />
                            {{ number_format($secondTrend, 1) }}%
                        </span>
                    @else
                        <span class="text-xs font-bold text-gray-400">— 0.0%</span>
                    @endif
                    <span class="text-sm font-extrabold text-gray-900">{{ number_format($second->current_mq_score, 0) }}</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="h-1.5 rounded-full bg-blue-400" style="width: {{ min(100, $second->current_mq_score) }}%"></div>
                </div>
            </div>
        </div>

        {{-- 1st Place --}}
        <div class="relative bg-[#4F6EF7] rounded-2xl p-5 flex flex-col shadow-lg shadow-indigo-200 -mt-3">
            <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center shadow">
                <x-lucide-crown class="w-4 h-4 text-yellow-900" />
            </div>
            <div class="flex items-center gap-4 mt-2">
                <div class="relative">
                    <img src="https://i.pravatar.cc/150?u={{ $first->email }}" class="w-14 h-14 rounded-full border-2 border-white/30 shadow object-cover" alt="{{ $first->name }}">
                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-yellow-400 rounded-full flex items-center justify-center">
                        <x-lucide-star class="w-2.5 h-2.5 text-yellow-900" />
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-base font-extrabold text-white truncate">{{ $first->name }}</p>
                    <p class="text-xs font-medium text-indigo-200 truncate">{{ $first->jobRole->title ?? 'Employee' }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between mb-1.5">
                    @if($firstTrend === null)
                        <span class="text-xs font-bold text-indigo-200">— N/A</span>
                    @elseif($firstTrend > 0)
                        <span class="flex items-center gap-1 text-green-300 text-xs font-bold">
                            <x-lucide-trending-up class="w-3.5 h-3.5" />
                            +{{ number_format($firstTrend, 1) }}%
                        </span>
                    @elseif($firstTrend < 0)
                        <span class="flex items-center gap-1 text-red-300 text-xs font-bold">
                            <x-lucide-trending-down class="w-3.5 h-3.5" />
                            {{ number_format($firstTrend, 1) }}%
                        </span>
                    @else
                        <span class="text-xs font-bold text-indigo-200">— 0.0%</span>
                    @endif
                    <span class="text-sm font-extrabold text-white">{{ number_format($first->current_mq_score, 0) }}</span>
                </div>
                <div class="w-full bg-indigo-400/40 rounded-full h-1.5">
                    <div class="h-1.5 rounded-full bg-yellow-400" style="width: {{ min(100, $first->current_mq_score) }}%"></div>
                </div>
            </div>
        </div>

        {{-- 3rd Place --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5 flex flex-col shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center text-sm font-extrabold text-orange-500 shrink-0">3</div>
                <img src="https://i.pravatar.cc/150?u={{ $third->email }}" class="w-12 h-12 rounded-full border-2 border-white shadow-sm object-cover" alt="{{ $third->name }}">
                <div class="flex-1 min-w-0">
                    <p class="text-base font-extrabold text-gray-900 truncate">{{ $third->name }}</p>
                    <p class="text-xs font-medium text-gray-400 truncate">{{ $third->jobRole->title ?? 'Employee' }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between mb-1.5">
                    @if($thirdTrend === null)
                        <span class="text-xs font-bold text-gray-400">— N/A</span>
                    @elseif($thirdTrend > 0)
                        <span class="flex items-center gap-1 text-green-500 text-xs font-bold">
                            <x-lucide-trending-up class="w-3.5 h-3.5" />
                            +{{ number_format($thirdTrend, 1) }}%
                        </span>
                    @elseif($thirdTrend < 0)
                        <span class="flex items-center gap-1 text-red-500 text-xs font-bold">
                            <x-lucide-trending-down class="w-3.5 h-3.5" />
                            {{ number_format($thirdTrend, 1) }}%
                        </span>
                    @else
                        <span class="text-xs font-bold text-gray-400">— 0.0%</span>
                    @endif
                    <span class="text-sm font-extrabold text-gray-900">{{ number_format($third->current_mq_score, 0) }}</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="h-1.5 rounded-full bg-orange-400" style="width: {{ min(100, $third->current_mq_score) }}%"></div>
                </div>
            </div>
        </div>
    </div>
@endif
