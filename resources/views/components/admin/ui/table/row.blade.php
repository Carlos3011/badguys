@props([
    'hover' => true,
    'clickable' => false,
    'selected' => false,
])

@php
    $classes = 'transition-all duration-150';
    if ($clickable) {
        $classes .= ' cursor-pointer';
    }
    if ($selected) {
        $classes .= ' bg-blue-50 border-l-4 border-blue-500';
    }
@endphp

<tr {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tr>