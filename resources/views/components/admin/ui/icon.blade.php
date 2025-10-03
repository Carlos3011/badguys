@props([
    'name' => null,
    'variant' => 'solid', // solid | regular | light | thin | duotone | brands
    'class' => '',
])

@php
    $variantClass = match($variant) {
        'regular' => 'fa-regular',
        'light' => 'fa-light',
        'thin' => 'fa-thin',
        'duotone' => 'fa-duotone',
        'brands' => 'fa-brands',
        default => 'fa-solid',
    };
    $iconClass = $name ? 'fa-' . $name : '';
@endphp

<i class="{{ $variantClass }} {{ $iconClass }} {{ $class }}"></i>