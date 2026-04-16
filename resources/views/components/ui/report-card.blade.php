@props(['title', 'description', 'iconColor' => 'blue'])

@php
$colorClasses = [
    'blue' => 'bg-blue-50 text-blue-600',
    'purple' => 'bg-purple-50 text-purple-600',
    'green' => 'bg-green-50 text-green-600',
    'orange' => 'bg-orange-50 text-orange-600',
];
$colorConfig = $colorClasses[$iconColor] ?? $colorClasses['blue'];
@endphp

<div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group cursor-pointer">
    <div class="{{ $colorConfig }} w-12 h-12 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
        {{ $icon }}
    </div>
    <h4 class="font-bold text-gray-900 mb-2">{{ $title }}</h4>
    <p class="text-sm text-gray-500 mb-4">{{ $description }}</p>
    <span class="text-{{ $iconColor }}-600 text-sm font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">View Sample <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></span>
</div>
