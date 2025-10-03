@props([
    'type' => 'default', // default | primary | success | warning | danger | info | secondary
    'outline' => false,
    'size' => 'md', // sm | md
])

@php
    $base = 'inline-flex items-center rounded-md font-montserrat';
    $sizes = [
        'sm' => 'text-xs px-2 py-1',
        'md' => 'text-sm px-3 py-1.5',
    ];

    $variants = [
        'default' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-300'],
        'primary' => ['bg' => 'bg-black', 'text' => 'text-white', 'border' => 'border-black'],
        'success' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-300'],
        'warning' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'border' => 'border-amber-300'],
        'danger'  => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'border' => 'border-red-300'],
        'info'    => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-300'],
        'secondary' => ['bg' => 'bg-gray-200', 'text' => 'text-gray-900', 'border' => 'border-gray-300'],
    ];

    $variant = $variants[$type] ?? $variants['default'];
    $outlineClasses = $outline ? "bg-white border {$variant['border']} {$variant['text']}" : "{$variant['bg']} {$variant['text']}";
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $classes = trim("$base $sizeClass $outlineClasses");
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>