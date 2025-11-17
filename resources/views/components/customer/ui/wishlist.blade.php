@props(['class' => ''])

@php
    $items = session('wishlist.items');
    $count = is_countable($items) ? count($items) : (int) (session('wishlist.count') ?? 0);
    $href = \Illuminate\Support\Facades\Route::has('customer.wishlist.index') ? route('customer.wishlist.index') : (\Illuminate\Support\Facades\Route::has('wishlist.index') ? route('wishlist.index') : '#');
@endphp

<a href="{{ $href }}" title="Favoritos" {{ $attributes->merge(['class' => trim('relative inline-flex items-center justify-center w-10 h-10 rounded-md border border-white/20 text-white hover:bg-white hover:text-black transition ' . $class)]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
        <path d="M11.645 20.91l-.007-.003-.022-.01a15.247 15.247 0 01-.363-.168 25.166 25.166 0 01-4.171-2.62C4.24 16.107 2 13.856 2 10.5 2 8.015 3.99 6 6.375 6 7.807 6 9.133 6.683 10 7.76 10.867 6.683 12.193 6 13.625 6 16.01 6 18 8.015 18 10.5c0 3.356-2.24 5.607-5.082 7.609a25.154 25.154 0 01-4.171 2.62 15.214 15.214 0 01-.363.168l-.022.01-.007.003a.75.75 0 01-.555 0z" />
    </svg>
    @if($count > 0)
        <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 min-w-[1.25rem] h-5 text-xs font-bold rounded-full bg-white text-black">{{ $count }}</span>
    @endif
</a>