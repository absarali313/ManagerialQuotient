@props(['title', 'description', 'iconColor' => 'purple'])

@php
$colorClasses = [
    'purple' => 'bg-purple-100 text-purple-600',
    'blue' => 'bg-blue-100 text-blue-600',
    'orange' => 'bg-orange-100 text-orange-600',
    'pink' => 'bg-pink-100 text-pink-600',
];
$colorConfig = $colorClasses[$iconColor] ?? $colorClasses['purple'];
@endphp

<div class="bg-white rounded-2xl p-6 shadow-sm border border-purple-100 hover:shadow-lg transition-shadow flex flex-col h-full">
    <div class="{{ $colorConfig }} w-10 h-10 rounded-lg flex items-center justify-center mb-5">
        {{ $icon }}
    </div>
    <h4 class="font-bold text-gray-900 mb-2">{{ $title }}</h4>
    <p class="text-sm text-gray-500 mb-4 flex-grow">{{ $description }}</p>
    <div>
        {{ $slot }}
    </div>
</div>
