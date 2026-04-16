@props(['title', 'description', 'type' => 'old'])

@php
$color = $type === 'old' ? 'red' : 'green';
@endphp

<li class="flex items-start gap-4">
    <div class="mt-1 flex-shrink-0 text-{{ $color }}-500">
        {{ $icon }}
    </div>
    <div>
        <p class="font-bold text-{{ $color }}-900">{{ $title }}</p>
        <p class="text-{{ $color }}-700/80 text-sm mt-1">{{ $description }}</p>
    </div>
</li>
