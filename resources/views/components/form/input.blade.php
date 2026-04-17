@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'icon' => null,
    'model' => null,
])

<div class="w-full" 
    @if($type === 'password') 
        x-data="{ show: false }" 
    @endif
>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-2 px-1">
            {{ $label }}
        </label>
    @endif
    
    <div class="relative group">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-20 text-gray-400 group-focus-within:text-blue-600 transition-colors">
                <div class="w-5 h-5 flex items-center justify-center">
                    {{ $icon }}
                </div>
            </div>
        @endif
        
        <input 
            @if($model) wire:model.blur="{{ $model }}" @endif
            id="{{ $id }}" 
            @if($type === 'password')
                :type="show ? 'text' : 'password'"
            @else
                type="{{ $type }}"
            @endif
            @if($required) required @endif
            placeholder="{{ $placeholder }}"
            class="block w-full border-gray-200 rounded-xl text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none py-3.5 pr-12 {{ $icon ? 'pl-11' : 'pl-4' }}"
            {{ $attributes->whereDoesntStartWith('class') }}
        >

        @if($type === 'password')
            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center z-20">
                <button 
                    type="button" 
                    @click="show = !show"
                    class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors"
                    aria-label="Toggle password visibility"
                >
                    <template x-if="!show">
                        <x-lucide-eye class="w-5 h-5" />
                    </template>
                    <template x-if="show">
                        <x-lucide-eye-off class="w-5 h-5" />
                    </template>
                </button>
            </div>
        @endif
    </div>
    
    @if($model)
        @error($model) 
            <p class="text-xs text-red-500 mt-2 px-1 flex items-center font-medium">
                <x-lucide-alert-circle class="w-4 h-4 mr-1.5 flex-shrink-0" />
                <span>{{ $message }}</span>
            </p> 
        @enderror
    @endif
</div>
