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
    $firstMedia = $product->getFirstMedia('default');
    $firstImageUrl = $firstMedia ? ('/storage/' . $firstMedia->id . '/' . $firstMedia->file_name) : null;
    $viewerImages = $images->map(function($img){ return '/storage/' . $img->id . '/' . $img->file_name; })->values();
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
                    <x-admin.ui.product-image 
                        :media="$images->first()" 
                        :product="$product"
                        id="{{ $componentId }}-main-image"
                        class="w-full h-full object-cover cursor-zoom-in transition-transform duration-300"
                        :clickable="false"
                        :showName="false"
                        onclick="window['openImageViewer{{ $componentId }}'](0)" />

                    {{-- Botón de Zoom --}}
                    <button 
                        type="button"
                        onclick="window['openImageViewer{{ $componentId }}'](0)"
                        class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm hover:bg-white text-gray-700 p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-200"
                        title="Ver imagen completa"
                    >
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </button>

                    @if($hasMultipleImages)
                        <button 
                            type="button"
                            onclick="window['previousMainImage{{ $componentId }}']()"
                            class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-black p-2 rounded-full shadow-md transition"
                            title="Anterior"
                        >
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button 
                            type="button"
                            onclick="window['nextMainImage{{ $componentId }}']()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-black p-2 rounded-full shadow-md transition"
                            title="Siguiente"
                        >
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                    
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
                        <i class="fas fa-image text-6xl mb-4"></i>
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
                            onclick="window['changeMainImage{{ $componentId }}']({{ $index }})"
                            class="thumbnail-{{ $componentId }} border-2 rounded-lg overflow-hidden transition-all duration-200 hover:border-black hover:shadow-md {{ $index === 0 ? 'border-black ring-2 ring-black' : 'border-gray-200' }}"
                            data-index="{{ $index }}"
                        >
                            <x-admin.ui.product-image 
                                :media="$media"
                                :product="$product"
                                class="w-full h-full object-cover aspect-square hover:scale-110 transition-transform duration-300"
                                :clickable="false"
                                :showName="false" />
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- Características adicionales de la imagen --}}
            @if($images->count() > 0)
                <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center gap-1">
                        <i class="fas fa-expand"></i>
                        <span>Click para ampliar</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    <div class="flex items-center gap-1">
                        <i class="fas fa-share-alt"></i>
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
                    <span class="inline-flex items-center bg-white text-black border border-black px-3 py-1.5 rounded-full text-sm font-semibold">
                        <i class="fas fa-tags mr-1.5"></i>
                        {{ $category->name }}
                    </span>
                @endif
                
                @if($brand)
                    <span class="inline-flex items-center bg-white text-black border border-black px-3 py-1.5 rounded-full text-sm font-semibold">
                        <i class="fas fa-tag mr-1.5"></i>
                        {{ $brand->name }}
                    </span>
                @endif
                
                @if($season)
                    <span class="inline-flex items-center bg-white text-black border border-black px-3 py-1.5 rounded-full text-sm font-semibold">
                        <i class="fas fa-leaf mr-1.5"></i>
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
                        <span class="inline-flex items-center bg-white text-black border border-black px-2 py-1 rounded-md text-xs font-semibold">
                            <i class="fas fa-clock mr-1"></i>
                            Estado: {{ ucfirst($state) }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Calificación (placeholder para futuro) --}}
            <div class="flex items-center gap-3">
                <div class="flex items-center">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= 4 ? 'text-black' : 'text-gray-300' }}"></i>
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
                    <i class="fas fa-info-circle mr-1"></i>
                    Precio incluye impuestos
                </p>
            </div>

            {{-- Descripción Corta (Excerpt) --}}
            @if($product->excerpt)
                <div class="bg-white border-l-4 border-black p-4 rounded-r-lg">
                    <p class="text-gray-800 text-lg leading-relaxed">
                        {{ $product->excerpt }}
                    </p>
                </div>
            @endif

            @if($product->height || $product->width || $product->length || $product->weight)
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                    @if($product->height)
                        <div class="text-sm text-gray-700"><span class="text-gray-500">Alto</span> <span class="font-semibold">{{ $product->height }} cm</span></div>
                    @endif
                    @if($product->width)
                        <div class="text-sm text-gray-700"><span class="text-gray-500">Ancho</span> <span class="font-semibold">{{ $product->width }} cm</span></div>
                    @endif
                    @if($product->length)
                        <div class="text-sm text-gray-700"><span class="text-gray-500">Largo</span> <span class="font-semibold">{{ $product->length }} cm</span></div>
                    @endif
                    @if($product->weight)
                        <div class="text-sm text-gray-700"><span class="text-gray-500">Peso</span> <span class="font-semibold">{{ $product->weight }} kg</span></div>
                    @endif
                </div>
            @endif

            <div class="py-3 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="font-semibold">Disponibilidad</span>
                        @if($isInStock)
                            <span class="inline-flex items-center text-black"><i class="fas fa-check mr-1"></i>En stock</span>
                        @else
                            <span class="inline-flex items-center text-black"><i class="fas fa-ban mr-1"></i>Agotado</span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-700">
                        Unidades: <span class="font-semibold">{{ number_format($stock, 0) }}</span>
                    </div>
                </div>
                @if($isLowStock)
                    <div class="mt-2 text-xs text-black"><i class="fas fa-exclamation-triangle mr-1"></i>Stock bajo</div>
                @endif
            </div>

            {{-- Selector de Cantidad --}}
            @if($isInStock)
                <div class="flex items-center gap-4">
                    <label for="{{ $componentId }}-quantity" class="text-sm font-semibold text-gray-700">Cantidad:</label>
                    <div class="group flex items-center rounded-xl border border-black bg-white shadow-sm overflow-hidden">
                        <button
                            type="button"
                            onclick="decrementQuantity{{ $componentId }}()"
                            class="h-11 w-11 flex items-center justify-center text-black transition-colors group-hover:bg-gray-50 hover:bg-black hover:text-white"
                            aria-label="Disminuir"
                        >
                            <i class="fas fa-minus"></i>
                        </button>
                        <input
                            type="number"
                            id="{{ $componentId }}-quantity"
                            value="1"
                            min="1"
                            max="{{ $stock }}"
                            class="w-20 text-center font-semibold text-gray-900 bg-transparent focus:outline-none focus:ring-0 h-11"
                        >
                        <button
                            type="button"
                            onclick="incrementQuantity{{ $componentId }}()"
                            class="h-11 w-11 flex items-center justify-center text-black transition-colors group-hover:bg-gray-50 hover:bg-black hover:text-white"
                            aria-label="Aumentar"
                        >
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <span class="text-sm text-gray-500">Máx: {{ $stock }}</span>
                </div>
            @endif

            {{-- Botones de Acción Principales --}}
            <div class="space-y-3">
                <button 
                    type="button"
                    class="w-full bg-black hover:bg-white hover:text-black text-white border border-black disabled:bg-gray-300 disabled:text-white disabled:cursor-not-allowed font-bold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-3 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    {{ !$isInStock ? 'disabled' : '' }}
                >
                    <i class="fas fa-shopping-cart"></i>
                    <span class="text-lg">{{ $isInStock ? 'Agregar al Carrito' : 'Producto No Disponible' }}</span>
                </button>
                
                <div class="grid grid-cols-2 gap-3">
                    <button 
                        type="button"
                        class="bg-white hover:bg-black hover:text-white text-black font-semibold py-3 px-4 rounded-xl border border-black transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"
                    >
                        <i class="fas fa-heart"></i>
                        <span>Favoritos</span>
                    </button>
                    
                    <button 
                        type="button"
                        class="bg-white hover:bg-black hover:text-white text-black font-semibold py-3 px-4 rounded-xl border border-black transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"
                    >
                        <i class="fas fa-share-alt"></i>
                        <span>Compartir</span>
                    </button>
                </div>
            </div>

            

            {{-- Descripción Completa --}}
            @if($product->description)
                <div class="border-t border-gray-200 pt-6 space-y-3">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-file-lines"></i>
                        Descripción del Producto
                    </h3>
                    <div class="prose prose-sm max-w-none text-gray-700 bg-gray-50 p-5 rounded-lg leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            @endif

            {{-- Información Adicional --}}
            {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-gray-200">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-white border border-black rounded-lg flex items-center justify-center">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">Envío Gratis</h4>
                        <p class="text-xs text-gray-500">En compras mayores a $500</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-white border border-black rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">Compra Segura</h4>
                        <p class="text-xs text-gray-500">Protección garantizada</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-white border border-black rounded-lg flex items-center justify-center">
                        <i class="fas fa-rotate-left"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 text-sm">Devoluciones</h4>
                        <p class="text-xs text-gray-500">30 días de garantía</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

{{-- Modal de Visor de Imágenes --}}
@if($images->count() > 0)
    <div id="{{ $componentId }}-image-viewer" class="hidden fixed inset-0 bg-black/95 z-50 flex items-center justify-center p-4" onclick="window['closeImageViewer{{ $componentId }}']()">
        <button onclick="window['closeImageViewer{{ $componentId }}']()" class="absolute top-6 right-6 text-white hover:text-gray-300 z-10 bg-black/50 rounded-full p-3 backdrop-blur-sm">
            <i class="fas fa-times text-2xl"></i>
        </button>
        
        @if($hasMultipleImages)
            {{-- Botón Anterior --}}
            <button 
                onclick="event.stopPropagation(); window['previousImage{{ $componentId }}']()" 
                class="absolute left-6 text-white hover:text-gray-300 z-10 bg-black/50 rounded-full p-4 backdrop-blur-sm transition-all hover:scale-110"
            >
                <i class="fas fa-chevron-left text-2xl"></i>
            </button>
            
            {{-- Botón Siguiente --}}
            <button 
                onclick="event.stopPropagation(); window['nextImage{{ $componentId }}']()" 
                class="absolute right-6 text-white hover:text-gray-300 z-10 bg-black/50 rounded-full p-4 backdrop-blur-sm transition-all hover:scale-110"
            >
                <i class="fas fa-chevron-right text-2xl"></i>
            </button>
        @endif
        
        <div class="relative max-w-7xl max-h-full" onclick="event.stopPropagation()">
            <img id="{{ $componentId }}-viewer-image" src="{{ $firstImageUrl }}" alt="{{ $product->name }}" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
            
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

<script>
(function() {
    const componentId = '{{ $componentId }}';
    const images = @json($viewerImages);
    let currentImageIndex = 0;

    // Cambiar imagen principal desde miniaturas
    window['changeMainImage{{ $componentId }}'] = function(index) {
        const main = document.getElementById(componentId + '-main-image');
        if (main && images[index]) {
            main.src = images[index];
        }
        const counter = document.getElementById(componentId + '-current-image');
        if (counter) {
            counter.textContent = index + 1;
        }
        currentImageIndex = index;
        document.querySelectorAll('.thumbnail-{{ $componentId }}').forEach((thumb, idx) => {
            if (idx === index) {
                thumb.classList.add('border-black', 'ring-2', 'ring-black');
                thumb.classList.remove('border-gray-200');
            } else {
                thumb.classList.remove('border-black', 'ring-2', 'ring-black');
                thumb.classList.add('border-gray-200');
            }
        });
    };

    window['previousMainImage{{ $componentId }}'] = function() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        window['changeMainImage{{ $componentId }}'](currentImageIndex);
    };

    window['nextMainImage{{ $componentId }}'] = function() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        window['changeMainImage{{ $componentId }}'](currentImageIndex);
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