@props([
    'variant' => 'success',
    'class' => ''
])

@php
    $variants = [
        'success' => 'bg-green-100 text-green-700',
        'warning' => 'bg-orange-100 text-orange-700',
        'danger' => 'bg-red-100 text-red-700',
        'neutral' => 'bg-gray-100 text-gray-700',
        'accent' => 'bg-[#D1FF1A] text-gray-900',
        'brand' => 'bg-indigo-50 text-indigo-700',
    ];
    $variantClass = $variants[$variant] ?? $variants['success'];
@endphp

<span {{ $attributes->merge(['class' => "$variantClass px-2 py-0.5 rounded-lg text-[11px] font-bold tracking-wide uppercase $class"]) }}>
    {{ $slot }}
</span>
