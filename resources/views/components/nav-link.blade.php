@props(['active' => false])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-3 py-2 text-white font-montserrat font-semibold border-b-2 border-white'
    : 'inline-flex items-center px-3 py-2 text-gray-300 hover:text-white font-montserrat font-medium transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
