<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Detalle del producto') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-roboto-flex text-gray-900">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 font-montserrat">SKU: {{ $product->sku }}</p>
                    </div>
                    <x-admin.ui.badge :type="(($product->is_active ?? true) ? 'success' : 'danger')">
                        {{ ($product->is_active ?? true) ? 'Activo' : 'Inactivo' }}
                    </x-admin.ui.badge>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <span class="block text-sm text-gray-500 font-montserrat">Categoría</span>
                        <span class="text-base font-montserrat text-gray-800">
                            {{ optional($product->taxons->firstWhere('taxonomy_id', 1))->name ?? '-' }}
                        </span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500 font-montserrat">Marca</span>
                        <span class="text-base font-montserrat text-gray-800">
                            {{ optional($product->taxons->firstWhere('taxonomy_id', 2))->name ?? '-' }}
                        </span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500 font-montserrat">Temporada</span>
                        <span class="text-base font-montserrat text-gray-800">
                            {{ optional($product->taxons->firstWhere('taxonomy_id', 3))->name ?? '-' }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-sm text-gray-500 font-montserrat">Precio</span>
                        <span class="text-xl font-semibold text-gray-900">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div>
                        <span class="block text-sm text-gray-500 font-montserrat">Stock</span>
                        <span class="text-xl font-semibold text-gray-900">{{ number_format($product->stock, 2) }}</span>
                    </div>
                </div>

                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-800">{{ __('Propiedades') }}</h4>
                    @forelse($product->propertyValues as $pv)
                        <div class="flex items-center justify-between py-2 border-b">
                            <span class="text-sm text-gray-500 font-montserrat">{{ $pv->property->name }}</span>
                            <span class="text-sm font-montserrat text-gray-800">{{ $pv->value }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 font-montserrat">{{ __('Sin propiedades asignadas') }}</p>
                    @endforelse
                </div>

                @php
                    $images = $product->getMedia('default');
                @endphp

                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-800">{{ __('Imágenes') }}</h4>
                    @if($images->count())
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                            @foreach($images as $img)
                                <img src="{{ asset($img->getUrl()) }}" alt="imagen" class="w-full h-32 object-cover rounded-lg border">
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 font-montserrat">{{ __('Sin imágenes') }}</p>
                    @endif
                </div>

                <div class="mt-8 flex items-center gap-3">
                    <x-admin.ui.button type="primary" :href="route('admin.products.edit', $product)">{{ __('Editar') }}</x-admin.ui.button>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('{{ __('¿Seguro que deseas eliminar este producto?') }}')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Eliminar') }}</x-danger-button>
                    </form>
                    <x-admin.ui.button type="secondary" :href="route('admin.products.index')">{{ __('Volver') }}</x-admin.ui.button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>