@props(['class' => ''])

@php
    $items = session('cart.items');
    $count = is_countable($items) ? count($items) : (int) (session('cart.count') ?? 0);
    $href = \Illuminate\Support\Facades\Route::has('customer.cart.index') ? route('customer.cart.index') : (\Illuminate\Support\Facades\Route::has('cart.index') ? route('cart.index') : '#');
@endphp

<a href="{{ $href }}" title="Carrito" {{ $attributes->merge(['class' => trim('relative inline-flex items-center justify-center w-10 h-10 rounded-md border border-white/20 text-white hover:bg-white hover:text-black transition ' . $class)]) }}>
    <i class="fas fa-shopping-cart text-base"></i>
    @if($count > 0)
        <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 min-w-[1.25rem] h-5 text-xs font-bold rounded-full bg-white text-black">{{ $count }}</span>
    @endif
</a>