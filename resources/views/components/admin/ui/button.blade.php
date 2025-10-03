@props([
    'type' => 'default', // default | primary | secondary | danger | link
    'href' => null,
    'size' => 'md', // sm | md | lg
    'icon' => null,
])

@php
    $base = 'inline-flex items-center justify-center rounded-lg font-montserrat transition-colors focus:outline-none';
    $sizes = [
        'sm' => 'text-xs px-2.5 py-1.5',
        'md' => 'text-sm px-3.5 py-2',
        'lg' => 'text-base px-4 py-2.5',
    ];

    $variants = [
        'default' => 'bg-white text-gray-800 border border-gray-300 hover:bg-gray-50',
        'primary' => 'bg-black text-white hover:bg-gray-800',
        'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'link' => 'bg-transparent text-black hover:underline',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $variantClass = $variants[$type] ?? $variants['default'];
    $classes = trim("$base $sizeClass $variantClass");
    $inner = trim($slot);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <span class="mr-2">{!! $icon !!}</span>
        @endif
        {{ $inner }}
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <span class="mr-2">{!! $icon !!}</span>
        @endif
        {{ $inner }}
    </button>
@endif