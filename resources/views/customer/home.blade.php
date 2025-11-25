<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 max-w-xl mx-auto">
                <x-ui.video-player provider="youtube" src="https://www.youtube.com/embed/dQw4w9WgXcQ" poster="{{ asset('image/logo-negro.png') }}" title="BIGI.NYC" />
            </div>
            {{-- <div class="mb-6">
                <x-customer.ui.search-bar />
            </div>
            <div class="mb-6">
                <x-customer.ui.filters :categories="$categories" />
            </div> --}}
            <div class="grid grid-cols-2 gap-6">
                @forelse($products as $product)
                    <div>
                        <x-customer.product.card :product="$product" :showActions="false" :showQuickView="false" cardSize="small" base="/system/storage/app/public/" />
                        <a href="{{ route('customer.products.show', $product) }}" class="mt-2 block text-sm font-medium text-gray-900">
                            {{ $product->name }}
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-black">{{ __('No hay productos disponibles.') }}</div>
                @endforelse
            </div>
        </div>
    </div>
</x-customer-layout>
