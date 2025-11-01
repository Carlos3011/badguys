{{--
    Componente: Product Detail Card
    Ubicación: resources/views/components/customer/product-detail-card.blade.php
    
    Props:
    - product (required): Instancia del modelo Product
    - showRelated (optional, default: false): Mostrar sección de productos relacionados
    - showReviews (optional, default: false): Mostrar sección de reseñas
    - layout (optional, default: 'default'): Layout del componente ('default', 'compact', 'wide')
--}}

@props([
    'product',
    'showRelated' => false,
    'showReviews' => false,
    'layout' => 'default'
])

@php
    // Obtener todas las imágenes del producto
    $images = $product->getMedia('default');
    $hasMultipleImages = $images->count() > 1;
    
    // Obtener taxonomías
    $category = $product->taxons->firstWhere('taxonomy_id', 1);
    $brand = $product->taxons->firstWhere('taxonomy_id', 2);
    $season = $product->taxons->firstWhere('taxonomy_id', 3);
    
    // Estado del producto
    $state = $product->state->value();
    $isActive = $state === 'active';
    
    // Stock y disponibilidad
    $stock = $product->stock;
    $isInStock = $stock > 0;
    $isLowStock = $stock > 0 && $stock <= 5;
    $isOutOfStock = $stock == 0;
    
    // Configuración de layouts
    $layoutClasses = [
        'default' => 'grid-cols-1 lg:grid-cols-2',
        'compact' => 'grid-cols-1 md:grid-cols-2',
        'wide' => 'grid-cols-1 xl:grid-cols-5'
    ];
    
    $layoutClass = $layoutClasses[$layout] ?? $layoutClasses['default'];
    
    // Generar ID único para este componente
    $componentId = 'product-detail-' . Str::random(8);
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-lg overflow-hidden']) }}>
    <div class="grid {{ $layoutClass }} gap-8 p-6 lg:p-8">
        
        {{-- Sección de Galería de Imágenes --}}
        <div class="{{ $layout === 'wide' ? 'xl:col-span-3' : '' }} space-y-4">
            
            {{-- Imagen Principal --}}
            <div class="relative bg-gray-100 rounded-xl overflow-hidden aspect-square group">
                @if($images->count() > 0)
                    <img 
                        id="{{ $componentId }}-main-image" 
                        src="{{ $images->first()->getUrl() }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover cursor-zoom-in transition-transform duration-300"
                        onclick="openImageViewer{{ $componentId }}(0)"
                    >
                    
                    {{-- Botón de Zoom --}}
                    <button 
                        type="button"
                        onclick="openImageViewer{{ $componentId }}(0)"
                        class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm hover:bg-white text-gray-700 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-200"
                        title="Ver imagen completa"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </button>
                    
                    {{-- Indicadores de navegación de imágenes --}}
                    @if($hasMultipleImages)
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/50 backdrop-blur-sm px-3 py-2 rounded-full">
                            <span class="text-white text-sm font-medium">
                                <span id="{{ $componentId }}-current-image">1</span> / {{ $images->count() }}
                            </span>
                        </div>
                    @endif
                @else
                    {{-- Placeholder sin imagen --}}
                    <div class="flex flex-col items-center justify-center h-full text-gray-400">
                        <svg class="w-32 h-32 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-lg font-medium">Sin imágenes disponibles</span>
                    </div>
                @endif
            </div>

            {{-- Miniaturas --}}
            @if($hasMultipleImages)
                <div class="grid grid-cols-4 md:grid-cols-5 lg:grid-cols-4 gap-2 lg:gap-3">
                    @foreach($images as $index => $media)
                        <button 
                            type="button"
                            onclick="changeMainImage{{ $componentId }}('{{ $media->getUrl() }}', {{ $index }})"
                            class="thumbnail-{{ $componentId }} border-2 rounded-lg overflow-hidden transition-all duration-200 hover:border-blue-500 hover:shadow-md {{ $index === 0 ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200' }}"
                            data-index="{{ $index }}"
                        >
                            <img 
                                src="{{ $media->getUrl() }}" 
                                alt="{{ $product->name }} - Imagen {{ $index + 1 }}"
                                class="w-full h-full object-cover aspect-square hover:scale-110 transition-transform duration-300"
                            >
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- Características adicionales de la imagen --}}
            @if($images->count() > 0)
                <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Click para ampliar</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        <span>Compartir</span>
                    </div>
                </div>
            @endif
        </div>

        {{-- Sección de Información del Producto --}}
        <div class="{{ $layout === 'wide' ? 'xl:col-span-2' : '' }} space-y-6">
            
            {{-- Breadcrumb / Tags de Taxonomía --}}
            <div class="flex flex-wrap items-center gap-2">
                @if($category)
                    <span class="inline-flex items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5 rounded-full text-sm font-semibold shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        {{ $category->name }}
                    </span>
                @endif
                
                @if($brand)
                    <span class="inline-flex items-center bg-gradient-to-r from-gray-600 to-gray-700 text-white px-3 py-1.5 rounded-full text-sm font-semibold shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $brand->name }}
                    </span>
                @endif
                
                @if($season)
                    <span class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 text-white px-3 py-1.5 rounded-full text-sm font-semibold shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $season->name }}
                    </span>
                @endif
            </div>

            {{-- Título del Producto --}}
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 font-roboto-flex mb-2 leading-tight">
                    {{ $product->name }}
                </h1>
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span class="font-mono">SKU: {{ $product->sku }}</span>
                    @if(!$isActive)
                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 px-2 py-1 rounded-md text-xs font-semibold">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Estado: {{ ucfirst($state) }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Calificación (placeholder para futuro) --}}
            <div class="flex items-center gap-3">
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <span class="text-sm text-gray-600">4.0 (Calificación de ejemplo)</span>
            </div>

            {{-- Precio --}}
            <div class="border-t border-b border-gray-200 py-6">
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="text-5xl font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </span>
                    <span class="text-xl text-gray-500 font-medium">MXN</span>
                </div>
                <p class="text-sm text-gray-500">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Precio incluye impuestos
                </p>
            </div>

            {{-- Descripción Corta (Excerpt) --}}
            @if($product->excerpt)
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                    <p class="text-gray-800 text-lg leading-relaxed">
                        {{ $product->excerpt }}
                    </p>
                </div>
            @endif

            {{-- Stock y Disponibilidad --}}
            <div class="bg-gradient-to-r {{ $isInStock ? 'from-green-50 to-emerald-50 border-green-200' : 'from-red-50 to-pink-50 border-red-200' }} border-2 rounded-xl p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Disponibilidad:</span>
                    @if($isInStock)
                        <span class="flex items-center text-green-700 font-bold text-lg">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            En Stock
                        </span>
                    @else
                        <span class="flex items-center text-red-700 font-bold text-lg">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            Agotado
                        </span>
                    @endif
                </div>
                
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="bg-white rounded-lg p-3">
                        <span class="block text-xs text-gray-500 mb-1">Unidades disponibles</span>
                        <span class="text-2xl font-bold {{ $isLowStock ? 'text-orange-600' : ($isInStock ? 'text-green-600' : 'text-red-600') }}">
                            {{ number_format($stock, 0) }}
                        </span>
                    </div>
                    <div class="bg-white rounded-lg p-3">
                        <span class="block text-xs text-gray-500 mb-1">Estado</span>
                        <span class="text-sm font-semibold {{ $isLowStock ? 'text-orange-600' : ($isInStock ? 'text-green-600' : 'text-red-600') }}">
                            {{ $isLowStock ? '⚠️ Stock Bajo' : ($isInStock ? '✓ Disponible' : '✗ Sin Stock') }}
                        </span>
                    </div>
                </div>
                
                @if($isLowStock)
                    <div class="mt-3 bg-orange-100 border border-orange-300 rounded-lg p-3">
                        <p class="text-sm text-orange-800 font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            ¡Últimas unidades! Ordena pronto antes de que se agoten.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Selector de Cantidad --}}
            @if($isInStock)
                <div class="flex items-center gap-4">
                    <label for="{{ $componentId }}-quantity" class="text-sm font-semibold text-gray-700">Cantidad:</label>
                    <div class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                        <button 
                            type="button"
                            onclick="decrementQuantity{{ $componentId }}()"
                            class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                        </button>
                        <input 
                            type="number" 
                            id="{{ $componentId }}-quantity"
                            value="1"
                            min="1"
                            max="{{ $stock }}"
                            class="w-16 text-center py-3 border-none focus:ring-0 font-semibold text-gray-900"
                        >
                        <button 
                            type="button"
                            onclick="incrementQuantity{{ $componentId }}()"
                            class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="text-sm text-gray-500">Máx: {{ $stock }}</span>
                </div>
            @endif

            {{-- Botones de Acción Principales --}}
            <div class="space-y-3">
                <button 
                    type="button"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 disabled:from-gray-300 disabled:to-gray-400 disabled:cursor-not-allowed text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-3 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    {{ !$isInStock ? 'disabled' : '' }}
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="text-lg">{{ $isInStock ? 'Agregar al Carrito' : 'Producto No Disponible' }}</span>
                </button>
                
                <div class="grid grid-cols-2 gap-3">
                    <button 
                        type="button"
                        class="bg-white hover:bg-gray-50 text-gray-900 font-semibold py-3 px-4 rounded-xl border-2 border-gray-300 transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span>Favoritos</span>
                    </button>
                    
                    <button 
                        type="button"
                        class="bg-white hover:bg-gray-50 text-gray-900 font-semibold py-3 px-4 rounded-xl border-2 border-gray-300 transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        <span>Compartir</span>
                    </button>
                </div>
            </div>

            {{-- Información Adicional --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-gray-200">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">Envío Gratis</h4>
                        <p class="text-xs text-gray-500">En compras mayores a $500</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">Compra Segura</h4>
                        <p class="text-xs text-gray-500">Protección garantizada</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">Devoluciones</h4>
                        <p class="text-xs text-gray-500">30 días de garantía</p>
                    </div>
                </div>
            </div>

            {{-- Descripción Completa --}}
            @if($product->description)
                <div class="border-t border-gray-200 pt-6 space-y-3">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Descripción del Producto
                    </h3>
                    <div class="prose prose-sm max-w-none text-gray-700 bg-gray-50 p-5 rounded-lg leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            @endif

            {{-- Especificaciones Técnicas --}}
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Especificaciones
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">SKU</span>
                        <span class="text-sm font-semibold text-gray-900 font-mono">{{ $product->sku }}</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Precio</span>
                        <span class="text-sm font-semibold text-gray-900">${{ number_format($product->price, 2) }} MXN</span>
                    </div>
                    @if($category)
                        <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Categoría</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $category->name }}</span>
                        </div>
                    @endif
                    @if($brand)
                        <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Marca</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $brand->name }}</span>
                        </div>
                    @endif
                    @if($season)
                        <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Temporada</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $season->name }}</span>
                        </div>
                    @endif
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Estado</span>
                        <span class="text-sm font-semibold text-gray-900">{{ ucfirst($state) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Visor de Imágenes --}}
@if($images->count() > 0)
    <div id="{{ $componentId }}-image-viewer" class="hidden fixed inset-0 bg-black/95 z-50 flex items-center justify-center p-4" onclick="closeImageViewer{{ $componentId }}()">
        <button onclick="closeImageViewer{{ $componentId }}()" class="absolute top-6 right-6 text-white hover:text-gray-300 z-10 bg-black/50 rounded-full p-3 backdrop-blur-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        @if($hasMultipleImages)
            {{-- Botón Anterior --}}
            <button 
                onclick="event.stopPropagation(); previousImage{{ $componentId }}()" 
                class="absolute left-6 text-white hover:text-gray-300 z-10 bg-black/50 rounded-full p-4 backdrop-blur-sm transition-all hover:scale-110"
            >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            {{-- Botón Siguiente --}}
            <button 
                onclick="event.stopPropagation(); nextImage{{ $componentId }}()" 
                class="absolute right-6 text-white hover:text-gray-300 z-10 bg-black/50 rounded-full p-4 backdrop-blur-sm transition-all hover:scale-110"
            >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif
        
        <div class="relative max-w-7xl max-h-full" onclick="event.stopPropagation()">
            <img id="{{ $componentId }}-viewer-image" src="{{ $images->first()->getUrl() }}" alt="{{ $product->name }}" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
            
            @if($hasMultipleImages)
                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 bg-black/70 backdrop-blur-sm px-4 py-2 rounded-full">
                    <span class="text-white text-sm font-medium">
                        <span id="{{ $componentId }}-viewer-counter">1</span> / {{ $images->count() }}
                    </span>
                </div>
            @endif
        </div>
    </div>
@endif

@push('scripts')
<script>
(function() {
    const componentId = '{{ $componentId }}';
    const images = @json($images->map(fn($img) => $img->getUrl())->values());
    let currentImageIndex = 0;

    // Cambiar imagen principal desde miniaturas
    window['changeMainImage{{ $componentId }}'] = function(imageUrl, index) {
        document.getElementById(componentId + '-main-image').src = imageUrl;
        document.getElementById(componentId + '-current-image').textContent = index + 1;
        currentImageIndex = index;
        
        // Actualizar estilos de miniaturas
        document.querySelectorAll('.thumbnail-{{ $componentId }}').forEach((thumb, idx) => {
            if (idx === index) {
                thumb.classList.add('border-blue-500', 'ring-2', 'ring-blue-200');
                thumb.classList.remove('border-gray-200');
            } else {
                thumb.classList.remove('border-blue-500', 'ring-2', 'ring-blue-200');
                thumb.classList.add('border-gray-200');
            }
        });
    };

    // Abrir visor de imágenes
    window['openImageViewer{{ $componentId }}'] = function(index) {
        currentImageIndex = index;
        updateViewerImage();
        document.getElementById(componentId + '-image-viewer').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    // Cerrar visor de imágenes
    window['closeImageViewer{{ $componentId }}'] = function() {
        document.getElementById(componentId + '-image-viewer').classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // Imagen anterior
    window['previousImage{{ $componentId }}'] = function() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateViewerImage();
    };

    // Imagen siguiente
    window['nextImage{{ $componentId }}'] = function() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        updateViewerImage();
    };

    // Actualizar imagen en el visor
    function updateViewerImage() {
        const viewerImage = document.getElementById(componentId + '-viewer-image');
        const viewerCounter = document.getElementById(componentId + '-viewer-counter');
        
        if (viewerImage && images[currentImageIndex]) {
            viewerImage.src = images[currentImageIndex];
        }
        
        if (viewerCounter) {
            viewerCounter.textContent = currentImageIndex + 1;
        }
    }

    // Incrementar cantidad
    window['incrementQuantity{{ $componentId }}'] = function() {
        const input = document.getElementById(componentId + '-quantity');
        const max = parseInt(input.max);
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    };

    // Decrementar cantidad
    window['decrementQuantity{{ $componentId }}'] = function() {
        const input = document.getElementById(componentId + '-quantity');
        const min = parseInt(input.min);
        const current = parseInt(input.value);
        if (current > min) {
            input.value = current - 1;
        }
    };

    // Navegación con teclado
    document.addEventListener('keydown', function(event) {
        const viewer = document.getElementById(componentId + '-image-viewer');
        if (!viewer.classList.contains('hidden')) {
            if (event.key === 'Escape') {
                window['closeImageViewer{{ $componentId }}']();
            } else if (event.key === 'ArrowLeft') {
                window['previousImage{{ $componentId }}']();
            } else if (event.key === 'ArrowRight') {
                window['nextImage{{ $componentId }}']();
            }
        }
    });
})();
</script>
@endpush