@props(['title', 'description', 'iconColor' => 'blue'])

<li class="bg-white/80 backdrop-blur rounded-2xl p-4 md:p-6 shadow-sm border border-{{ $iconColor }}-50/50 flex gap-4 items-start">
    <div class="mt-1 flex-shrink-0 text-{{ $iconColor }}-500">
        {{ $icon }}
    </div>
    <div>
        <p class="font-bold text-gray-900">{{ $title }}</p>
        <p class="text-gray-600 text-sm mt-1">{{ $description }}</p>
    </div>
</li>
