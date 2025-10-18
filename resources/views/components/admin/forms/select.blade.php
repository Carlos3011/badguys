@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => 'Seleccionar...',
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

    <div class="relative">
        @if($icon)
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="{{ $icon }} text-gray-400"></i>
            </div>
        @endif
        
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge(['class' => ($icon ? 'pl-10 ' : '') . 'block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-montserrat transition-all duration-200 hover:border-gray-400']) }}
        >
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $value => $optionLabel)
                <option value="{{ $value }}" @selected(old($name, $selected) == $value)>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
        
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
        </div>
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