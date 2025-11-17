@props(['product'])

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
    {{-- Header con nombre, SKU y estado --}}
    <div class="flex items-start justify-between mb-6">
        <div>
            <h3 class="text-2xl font-roboto-flex text-gray-900">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500 font-montserrat">SKU: {{ $product->sku }}</p>
        </div>
        @php
            $state = $product->state->value();
            $stateConfig = [
                'active' => ['type' => 'success', 'icon' => 'fas fa-check-circle', 'label' => 'Activo'],
                'draft' => ['type' => 'warning', 'icon' => 'fas fa-clock', 'label' => 'Borrador'],
                'inactive' => ['type' => 'danger', 'icon' => 'fas fa-times-circle', 'label' => 'Inactivo'],
            ];
            $current = $stateConfig[$state] ?? [
                'type' => 'secondary',
                'icon' => 'fas fa-tag',
                'label' => ucfirst($state),
            ];
        @endphp

        <x-admin.ui.badge :type="$current['type']" :icon="$current['icon']" size="lg">
            {{ $current['label'] }}
        </x-admin.ui.badge>
    </div>

    {{-- Información de taxonomías (Categoría, Marca, Temporada) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <span class="block text-sm text-gray-500 font-montserrat mb-1">Categoría</span>
            <span class="text-base font-semibold font-montserrat text-gray-800">
                {{ optional($product->taxons->firstWhere('taxonomy_id', 1))->name ?? '-' }}
            </span>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
            <span class="block text-sm text-gray-500 font-montserrat mb-1">Marca</span>
            <span class="text-base font-semibold font-montserrat text-gray-800">
                {{ optional($product->taxons->firstWhere('taxonomy_id', 2))->name ?? '-' }}
            </span>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
            <span class="block text-sm text-gray-500 font-montserrat mb-1">Temporada</span>
            <span class="text-base font-semibold font-montserrat text-gray-800">
                {{ optional($product->taxons->firstWhere('taxonomy_id', 3))->name ?? '-' }}
            </span>
        </div>
    </div>

    {{-- Información de precio y stock --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6">
            <span class="block text-sm text-blue-700 font-montserrat mb-2">Precio</span>
            <span class="text-3xl font-bold text-blue-900">${{ number_format($product->price, 2) }}</span>
            <span class="text-sm text-blue-700 ml-1">USD</span>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6">
            <span class="block text-sm text-green-700 font-montserrat mb-2">Stock</span>
            <span class="text-3xl font-bold text-green-900">{{ number_format($product->stock, 0) }}</span>
            <span class="text-sm text-green-700 ml-1">unidades</span>
        </div>
    </div>

    {{-- Información adicional (dimensiones, peso, meta) --}}
    @if($product->weight || $product->height || $product->width || $product->length || $product->meta_title || $product->meta_description)
        <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Información adicional') }}</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if($product->weight)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Peso</span>
                        <span class="text-base font-semibold font-montserrat text-gray-800">{{ $product->weight }} kg</span>
                    </div>
                @endif
                @if($product->height)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Alto</span>
                        <span class="text-base font-semibold font-montserrat text-gray-800">{{ $product->height }} cm</span>
                    </div>
                @endif
                @if($product->width)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Ancho</span>
                        <span class="text-base font-semibold font-montserrat text-gray-800">{{ $product->width }} cm</span>
                    </div>
                @endif
                @if($product->length)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Largo</span>
                        <span class="text-base font-semibold font-montserrat text-gray-800">{{ $product->length }} cm</span>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Meta información SEO --}}
    @if($product->meta_title || $product->meta_description || $product->meta_keywords)
        <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Información SEO') }}</h4>
            <div class="space-y-4">
                @if($product->meta_title)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Meta Título</span>
                        <span class="text-base font-montserrat text-gray-800">{{ $product->meta_title }}</span>
                    </div>
                @endif
                @if($product->meta_description)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Meta Descripción</span>
                        <span class="text-base font-montserrat text-gray-800">{{ $product->meta_description }}</span>
                    </div>
                @endif
                @if($product->meta_keywords)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="block text-sm text-gray-500 font-montserrat mb-1">Meta Palabras Clave</span>
                        <span class="text-base font-montserrat text-gray-800">{{ $product->meta_keywords }}</span>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Extracto del producto --}}
    @if($product->excerpt)
        <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Extracto') }}</h4>
            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $product->excerpt }}</p>
        </div>
    @endif

    {{-- Descripción del producto --}}
    @if($product->description)
        <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Descripción') }}</h4>
            <div class="text-gray-700 bg-gray-50 p-4 rounded-lg prose max-w-none">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    @endif

    {{-- Imágenes del producto --}}
    @if ($product->hasImages())
        <div class="mt-8">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Imágenes del producto') }}</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($product->getMedia('default') as $img)
                    <x-admin.ui.product-image 
                        :media="$img"
                        :product="$product"
                        class="w-full h-48 object-cover rounded-lg border-2 border-gray-200"
                        :clickable="true"
                        :showName="false" />
                @endforeach
            </div>
        </div>
    @endif

    {{-- Información de fechas --}}
    <div class="mt-8 pt-6 border-t border-gray-200">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Información del sistema') }}</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <span class="block text-sm text-gray-500 font-montserrat mb-1">Fecha de creación</span>
                <span class="text-base font-montserrat text-gray-800">
                    {{ $product->created_at ? $product->created_at->format('d/m/Y H:i') : '-' }}
                </span>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <span class="block text-sm text-gray-500 font-montserrat mb-1">Última actualización</span>
                <span class="text-base font-montserrat text-gray-800">
                    {{ $product->updated_at ? $product->updated_at->format('d/m/Y H:i') : '-' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Acciones administrativas --}}
    <div class="mt-8 flex items-center gap-3 border-t pt-6">
        <a href="{{ route('admin.products.edit', $product) }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            {{ __('Editar producto') }}
        </a>

        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
            onsubmit="return confirm('{{ __('¿Seguro que deseas eliminar este producto?') }}')"
            class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
                {{ __('Eliminar producto') }}
            </button>
        </form>
    </div>
</div>