@props([
    'label' => null,
    'id' => null,
    'model' => null,
])

<div class="flex items-center group cursor-pointer">
    <div class="relative flex items-center">
        <input 
            @if($model) wire:model="{{ $model }}" @endif
            id="{{ $id }}" 
            type="checkbox" 
            {{ $attributes->merge(['class' => 'h-5 w-5 text-blue-600 focus:ring-blue-500/20 border-gray-300 rounded cursor-pointer transition-all duration-200']) }}
        >
    </div>
    @if($label)
        <label for="{{ $id }}" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer select-none group-hover:text-gray-900 transition-colors duration-200">
            {{ $label }}
        </label>
    @endif
</div>
