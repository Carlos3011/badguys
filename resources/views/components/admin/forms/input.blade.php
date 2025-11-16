@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'help' => null,
    'required' => false,
    'icon' => null,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 font-montserrat mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <div class="relative rounded-lg shadow-sm">
        @if($icon)
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="{{ $icon }} text-gray-400"></i>
            </div>
        @endif
        
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if($required) required @endif
            {{ $attributes->merge(['class' => ($icon ? 'pl-10 ' : '') . 'block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-montserrat transition-all duration-200 hover:border-gray-400']) }}
        />
    </div>

    @if($help)
        <p class="mt-1.5 text-xs text-gray-500 flex items-center gap-1.5">
            <i class="fas fa-info-circle"></i>
            {{ $help }}
        </p>
    @endif

    @error($name)
        <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1.5">
            <i class="fas fa-exclamation-circle"></i>
            {{ $message }}
        </p>
    @enderror
</div>