@props(['active' => false])

@php
$classes = ($active ?? false)
    ? 'group flex items-center w-full px-4 py-2 rounded-lg bg-white/10 text-white font-montserrat font-semibold border border-gray-600'
    : 'group flex items-center w-full px-4 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 font-montserrat font-medium transition-all duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @isset($icon)
        <span class="mr-3 text-gray-400 group-hover:text-white">
            {{ $icon }}
        </span>
    @endisset
    <span class="tracking-wide">{{ $slot }}</span>
</a>