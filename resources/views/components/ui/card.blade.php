@props(['padding' => 'p-6', 'class' => ''])

<div {{ $attributes->merge(['class' => "bg-white border border-gray-100 rounded-[24px] shadow-sm shadow-black/[0.02] $padding $class"]) }}>
    {{ $slot }}
</div>
