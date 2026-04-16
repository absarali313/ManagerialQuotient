@props(['title', 'description', 'iconColor' => 'blue'])

@php
$colorClasses = [
    'blue' => 'bg-blue-50 text-blue-600',
    'purple' => 'bg-purple-50 text-purple-600',
    'green' => 'bg-green-50 text-green-600',
    'yellow' => 'bg-yellow-50 text-yellow-600',
    'indigo' => 'bg-indigo-50 text-indigo-600',
    'pink' => 'bg-pink-50 text-pink-600',
];
$colorConfig = $colorClasses[$iconColor] ?? $colorClasses['blue'];
@endphp

<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
    <div class="{{ $colorConfig }} w-12 h-12 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
        {{ $icon }}
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $title }}</h3>
    <p class="text-gray-500 leading-relaxed">
        {{ $description }}
    </p>
</div>
