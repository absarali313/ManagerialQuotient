<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($stats as $stat)
        <x-ui.card padding="p-5">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 {{ $stat['icon_bg'] }} rounded-xl flex items-center justify-center">
                    @php $iconName = "lucide-" . ($stat['icon'] ?? 'circle'); @endphp
                    <x-dynamic-component :component="$iconName" class="w-5 h-5 {{ $stat['icon_color'] }}" />
                </div>
                @if(isset($stat['change']))
                    <x-ui.badge variant="success">{{ $stat['change'] }}</x-ui.badge>
                @endif
                @if(isset($stat['badge']))
                    <x-ui.badge variant="neutral" class="bg-gray-100/50">{{ $stat['badge'] }}</x-ui.badge>
                @endif
                @if(isset($stat['status_icon']))
                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <x-lucide-check class="w-3.5 h-3.5 stroke-[3]" />
                    </div>
                @endif
            </div>

            <div class="space-y-1">
                <p class="text-xs font-semibold text-gray-400 tracking-wide">{{ $stat['label'] }}</p>
                <div class="flex items-baseline gap-1.5">
                    <h3 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $stat['value'] }}</h3>
                    @if(isset($stat['total']))
                        <span class="text-sm font-semibold text-gray-300">/ {{ $stat['total'] }}</span>
                    @endif
                    @if(isset($stat['subtitle']))
                        <span class="text-xs font-medium text-gray-400 ml-0.5">{{ $stat['subtitle'] }}</span>
                    @endif
                </div>
            </div>
        </x-ui.card>
    @endforeach
</div>
