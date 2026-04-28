@php
    $cards = [
        ['label' => 'Total',     'value' => $stats['total'],    'icon' => 'users',       'color' => 'text-[#5D45FD]', 'bg' => 'bg-purple-50'],
        ['label' => 'Active',    'value' => $stats['active'],   'icon' => 'user-check',  'color' => 'text-green-600',  'bg' => 'bg-green-50'],
        ['label' => 'Inactive',  'value' => $stats['inactive'], 'icon' => 'user-x',      'color' => 'text-red-500',    'bg' => 'bg-red-50'],
        ['label' => 'Avg Score', 'value' => $stats['avgScore'], 'icon' => 'bar-chart-2', 'color' => 'text-blue-600',   'bg' => 'bg-blue-50'],
    ];
@endphp

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach ($cards as $card)
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-5 py-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl {{ $card['bg'] }} flex items-center justify-center shrink-0">
                <x-dynamic-component :component="'lucide-' . $card['icon']" class="w-5 h-5 {{ $card['color'] }}" />
            </div>
            <div>
                <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">{{ $card['label'] }}</p>
                <p class="text-xl font-extrabold text-gray-900 leading-tight">{{ $card['value'] }}</p>
            </div>
        </div>
    @endforeach
</div>
