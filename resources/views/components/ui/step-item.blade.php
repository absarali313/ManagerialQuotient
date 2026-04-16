@props(['number', 'title', 'description', 'color' => 'blue', 'isActive' => false])

@php
$borderColors = [
    'blue' => 'border-blue-500',
    'indigo' => 'border-indigo-500',
    'purple' => 'border-purple-200',
    'pink' => 'border-pink-500',
    'green' => 'border-green-500',
];

$textColors = [
    'blue' => 'text-blue-600',
    'indigo' => 'text-indigo-600',
    'purple' => 'text-purple-600',
    'pink' => 'text-pink-600',
    'green' => 'text-green-600',
];

$borderColor = $borderColors[$color] ?? 'border-gray-500';
$textColor = $textColors[$color] ?? 'text-gray-600';
@endphp

<div class="relative bg-white lg:bg-transparent lg:shadow-none shadow-sm rounded-xl p-6 lg:p-0 text-center z-10 border lg:border-none border-gray-100 {{ $isActive ? 'transform lg:-translate-y-4' : '' }}">
    <div class="w-16 h-16 mx-auto {{ $isActive ? 'bg-'.$color.'-600 border-4 border-'.$color.'-200 text-white shadow-xl shadow-'.$color.'-500/30' : 'bg-white border-2 '.$borderColor.' '.$textColor.' shadow-lg' }} rounded-full flex items-center justify-center font-bold text-xl mb-6 relative">
        @if($isActive)
        <div class="absolute inset-0 rounded-full bg-{{ $color }}-400 animate-ping opacity-20"></div>
        <div class="w-20 h-20 absolute -m-2 opacity-0"></div> <!-- spacing matching to keep layout from jumping -->
        @endif
        {{ $icon }}
    </div>
    <div class="{{ $textColor }} font-black text-sm tracking-widest mb-2">{{ $number }}</div>
    <h4 class="font-bold text-gray-900 mb-2">{{ $title }}</h4>
    <p class="text-sm text-gray-500">{{ $description }}</p>
</div>
