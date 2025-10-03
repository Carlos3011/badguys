@props([
    'label' => null,
    'name' => null,
    'options' => [], // ['value' => 'Label'] or [['value'=>..., 'label'=>...]]
    'value' => null,
    'placeholder' => null,
    'help' => null,
    'required' => false,
])

@php
    $normalized = [];
    foreach ($options as $key => $opt) {
        if (is_array($opt)) {
            $normalized[] = [
                'value' => $opt['value'] ?? $opt['id'] ?? $key,
                'label' => $opt['label'] ?? $opt['name'] ?? $opt['title'] ?? $opt['value'] ?? $key,
            ];
        } else {
            $normalized[] = [
                'value' => is_string($key) ? $key : $opt,
                'label' => $opt,
            ];
        }
    }
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 font-montserrat mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-600">*</span>
            @endif
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat']) }}>
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($normalized as $opt)
            <option value="{{ $opt['value'] }}" @selected(old($name, $value)==$opt['value'])>{{ $opt['label'] }}</option>
        @endforeach
    </select>

    @if($help)
        <p class="mt-1 text-xs text-gray-500">{{ $help }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>