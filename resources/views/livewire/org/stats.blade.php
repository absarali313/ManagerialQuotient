<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-5">
    @foreach($stats as $stat)
        <x-ui.card class="border-none shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="flex items-center justify-between">
                    <div class="p-2.5 {{ $stat['icon_bg'] }} {{ $stat['icon_color'] }} rounded-xl group-hover:scale-110 transition-transform duration-300">
                        @if($stat['icon'] === 'presentation-chart-line')
                            <x-lucide-line-chart class="w-5 h-5" />
                        @elseif($stat['icon'] === 'star')
                            <x-lucide-star class="w-5 h-5" />
                        @elseif($stat['icon'] === 'exclamation-triangle')
                            <x-lucide-alert-triangle class="w-5 h-5" />
                        @elseif($stat['icon'] === 'rectangle-stack')
                            <x-lucide-layers class="w-5 h-5" />
                        @elseif($stat['icon'] === 'users')
                            <x-lucide-users class="w-5 h-5" />
                        @endif
                    </div>
                    @if(isset($stat['change']))
                        <div class="flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold {{ $stat['change_type'] === 'up' ? 'bg-green-50 text-green-600' : ($stat['change_type'] === 'down' ? 'bg-red-50 text-red-600' : 'bg-gray-50 text-gray-400') }}">
                            @if($stat['change_type'] === 'up')
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                            @elseif($stat['change_type'] === 'down')
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            @endif
                            {{ $stat['change'] }}
                        </div>
                    @endif
                </div>

                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $stat['label'] }}</p>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-2xl font-extrabold text-gray-900">{{ $stat['value'] }}</span>
                        @if(isset($stat['total']))
                            <span class="text-xs font-bold text-gray-300">{{ $stat['total'] }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </x-ui.card>
    @endforeach
</div>
