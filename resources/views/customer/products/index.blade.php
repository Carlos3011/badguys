<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- <div class="mb-6">
                <x-customer.ui.search-bar />
            </div>
            <div class="mb-6">
                <x-customer.ui.filters :categories="$categories" />
            </div> --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <x-customer.product.card :product="$product" :showActions="false" :showQuickView="false" cardSize="default" />
                @empty
                    <div class="col-span-full text-center text-black">{{ __('No hay productos disponibles.') }}</div>
                @endforelse
            </div>
            @if(method_exists($products, 'links'))
            <div class="mt-8">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</x-customer-layout>