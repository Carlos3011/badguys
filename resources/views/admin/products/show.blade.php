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
                    @php
                        $state = $product->state->value();
                        $stateConfig = [
                            'active' => ['type' => 'success', 'label' => 'Activo'],
                            'draft' => ['type' => 'warning', 'label' => 'Pendiente'],
                            'inactive' => ['type' => 'danger', 'label' => 'Inactivo'],
                            'unavailable' => ['type' => 'warning', 'label' => 'No disponible'],
                            'retired' => ['type' => 'secondary', 'label' => 'Retirado'],
                        ];
                        $currentState = $stateConfig[$state] ?? ['type' => 'secondary', 'label' => ucfirst($state)];
                    @endphp
                    <x-admin.ui.badge :type="$currentState['type']">
                        {{ $currentState['label'] }}
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

                @php
                    $images = $product->getMedia('default');
                @endphp

                @if($images->count())
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ __('Imágenes') }}</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($images as $img)
                                <div class="relative group">
                                    <img 
                                        src="{{ asset($img->getUrl()) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 hover:border-gray-300 transition-colors cursor-pointer"
                                        onclick="window.open('{{ asset($img->getUrl()) }}', '_blank')">
                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 rounded-b-lg">
                                        <p class="truncate">{{ $img->file_name }}</p>
                                    </div>
                                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                                            Click para ampliar
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ __('Propiedades') }}</h4>
                    @forelse($product->propertyValues as $pv)
                        <div class="flex items-center justify-between py-3 border-b last:border-b-0">
                            <span class="text-sm text-gray-500 font-montserrat">{{ $pv->property->name }}</span>
                            <span class="text-sm font-semibold font-montserrat text-gray-800">{{ $pv->value }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 font-montserrat">{{ __('Sin propiedades asignadas') }}</p>
                    @endforelse
                </div>

                <div class="mt-8 flex items-center gap-3 border-t pt-6">
                    <x-admin.ui.button type="primary" :href="route('admin.products.edit', $product)">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('Editar') }}
                    </x-admin.ui.button>
                    
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('{{ __('¿Seguro que deseas eliminar este producto?') }}')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            {{ __('Eliminar') }}
                        </x-danger-button>
                    </form>
                    
                    <x-admin.ui.button type="secondary" :href="route('admin.products.index')">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('Volver') }}
                    </x-admin.ui.button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>