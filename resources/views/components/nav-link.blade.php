@props(['active'])

@php
$classes = ($active ?? false)
            ? 'group relative inline-flex items-center px-4 py-2 border-b-2 border-white text-sm font-montserrat font-bold leading-5 text-white focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out'
            : 'group relative inline-flex items-center px-4 py-2 border-b-2 border-transparent text-sm font-montserrat font-medium leading-5 text-gray-300 hover:text-white hover:border-gray-500 focus:outline-none focus:text-white focus:border-gray-500 transition-all duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <!-- Enhanced background for active state -->
    @if($active ?? false)
        <div class="absolute inset-0 bg-gray-800/20 rounded-lg"></div>
        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-white"></div>
    @endif
    
    <!-- Hover background for inactive state -->
    <div class="absolute inset-0 bg-gray-800/10 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Content -->
    <span class="relative z-10 tracking-wide">{{ $slot }}</span>
</a>
