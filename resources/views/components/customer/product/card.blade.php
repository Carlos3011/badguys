{{--
    Componente: Product Card
    Ubicación: resources/views/components/customer/product/card.blade.php
    
    Props:
    - product (required): Instancia del modelo Product
    - showActions (optional, default: false): Mostrar botón de agregar al carrito
    - showQuickView (optional, default: false): Mostrar botón de vista rápida
    - cardSize (optional, default: 'default'): Tamaño de la card ('small', 'default', 'large')
--}}

@props(['product', 'showActions' => false, 'showQuickView' => false, 'cardSize' => 'default'])

@php
    // Configuración de tamaños
    $sizeClasses = [
        'small' => [
            'container' => 'max-w-xs',
            'image' => 'h-48',
            'title' => 'text-base',
            'price' => 'text-xl',
            'padding' => 'p-3',
        ],
        'default' => [
            'container' => 'max-w-sm',
            'image' => 'h-64',
            'title' => 'text-lg',
            'price' => 'text-2xl',
            'padding' => 'p-4',
        ],
        'large' => [
            'container' => 'max-w-md',
            'image' => 'h-80',
            'title' => 'text-xl',
            'price' => 'text-3xl',
            'padding' => 'p-5',
        ],
    ];

    $size = $sizeClasses[$cardSize] ?? $sizeClasses['default'];

    // Obtener taxonomías
    $category = $product->taxons->firstWhere('taxonomy_id', 1);
    $brand = $product->taxons->firstWhere('taxonomy_id', 2);
    $season = $product->taxons->firstWhere('taxonomy_id', 3);

    // Estado del producto
    $state = $product->state->value();
    $isActive = $state === 'active';
    $isDraft = $state === 'draft';

    // Stock
    $stock = $product->stock;
    $isInStock = $stock > 0;
    $isLowStock = $stock > 0 && $stock <= 5;
    $isOutOfStock = $stock == 0;

    // Obtener todas las imágenes del producto
    $productImages = $product->hasImages() ? $product->getMedia('default')->take(4) : collect();

    // ID único para el slideshow
    $slideshowId = 'slideshow-' . $product->id;
@endphp

<div
    {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 ' . $size['container']]) }}>

    {{-- Contenedor de Imagen con Slideshow --}}
    <div class="relative {{ $size['image'] }} bg-gray-100 overflow-hidden group">

        @if ($productImages->count() > 0)
            {{-- Slideshow Container --}}
            <div id="{{ $slideshowId }}" class="relative w-full h-full">
                {{-- Imágenes del Slideshow --}}
                @foreach ($productImages as $index => $image)
                    <div class="slideshow-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                        data-slide="{{ $index }}">
                        <div class="w-full h-full flex items-center justify-center bg-gray-50 overflow-hidden">
                            <x-admin.ui.product-image :media="$image" :product="$product"
                                class="w-full h-full object-cover object-center border-0 rounded-none" :clickable="false"
                                :showName="false" />
                        </div>
                    </div>
                @endforeach

                {{-- Indicadores de Slide --}}
                @if ($productImages->count() > 1)
                    <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex gap-1.5 z-10">
                        @foreach ($productImages as $index => $image)
                            <div class="slideshow-indicator w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"
                                data-slide="{{ $index }}"></div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Overlay en hover --}}
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
            </div>
        @else
            {{-- Placeholder cuando no hay imagen --}}
            <div
                class="flex flex-col items-center justify-center h-full text-gray-400 bg-gradient-to-br from-gray-100 to-gray-200">
                <svg class="w-20 h-20 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="text-sm font-medium">Sin imagen</span>
            </div>
        @endif

        {{-- Badges Superiores --}}
        <div class="absolute top-3 left-3 right-3 flex justify-between items-start gap-2 z-30">
            <div class="flex flex-col gap-2">
                {{-- Badge de Estado Borrador --}}
                @if ($isDraft)
                    <span
                        class="inline-flex items-center gap-1 bg-yellow-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Borrador
                    </span>
                @endif

                {{-- Badge de Stock Bajo --}}
                @if ($isLowStock)
                    <span
                        class="inline-flex items-center gap-1 bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-pulse">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        ¡{{ $stock }} {{ Str::plural('unidad', $stock) }}!
                    </span>
                @endif

                {{-- Badge de Agotado --}}
                @if ($isOutOfStock)
                    <span
                        class="inline-flex items-center gap-1 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Agotado
                    </span>
                @endif
            </div>

            {{-- Botón de Favoritos --}}
            <button type="button"
                class="bg-white/90 backdrop-blur-sm hover:bg-white text-gray-700 hover:text-red-500 p-2 rounded-full shadow-lg transition-all duration-200 opacity-0 group-hover:opacity-100"
                title="Agregar a favoritos">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Botón de Vista Rápida (opcional) --}}
        @if ($showQuickView)
            <div
                class="absolute bottom-3 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-30 {{ $productImages->count() > 1 ? 'mb-8' : '' }}">
                <button type="button"
                    class="bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-2 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Vista Rápida
                </button>
            </div>
        @endif
    </div>

    {{-- Contenido de la Card --}}
    <div class="{{ $size['padding'] }}">

        {{-- Categoría y Marca --}}
        <div class="flex items-center gap-2 text-xs mb-2 flex-wrap">
            @if ($category)
                <span class="inline-flex items-center bg-blue-50 text-blue-700 px-2 py-1 rounded-md font-medium">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                        </path>
                    </svg>
                    {{ $category->name }}
                </span>
            @endif

            @if ($brand)
                <span class="inline-flex items-center bg-gray-100 text-gray-700 px-2 py-1 rounded-md font-medium">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ $brand->name }}
                </span>
            @endif

            @if ($season)
                <span class="inline-flex items-center bg-green-50 text-green-700 px-2 py-1 rounded-md font-medium">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ $season->name }}
                </span>
            @endif
        </div>

        {{-- Nombre del Producto --}}
        <h3
            class="font-roboto-flex {{ $size['title'] }} font-semibold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem] leading-tight hover:text-blue-600 transition-colors cursor-pointer">
            {{ $product->name }}
        </h3>

        {{-- Excerpt (Descripción Corta) --}}
        @if ($product->excerpt)
            <p class="text-sm text-gray-600 mb-3 line-clamp-2 leading-relaxed">
                {{ $product->excerpt }}
            </p>
        @endif

        {{-- SKU --}}
        <div class="text-xs text-gray-400 mb-3 font-mono">
            SKU: {{ $product->sku }}
        </div>

        {{-- Separador --}}
        <div class="border-t border-gray-100 my-3"></div>

        {{-- Precio y Stock --}}
        <div class="flex items-end justify-between mb-3">
            <div>
                <div class="flex items-baseline gap-1">
                    <span class="{{ $size['price'] }} font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </span>
                    <span class="text-sm text-gray-500 font-medium">MXN</span>
                </div>

                {{-- Indicador de Stock --}}
                <div class="flex items-center gap-1 mt-1">
                    @if ($isInStock)
                        <div class="w-2 h-2 rounded-full {{ $isLowStock ? 'bg-orange-500' : 'bg-green-500' }}"></div>
                        <span class="text-xs {{ $isLowStock ? 'text-orange-600' : 'text-green-600' }} font-medium">
                            {{ number_format($stock, 0) }} disponible{{ $stock > 1 ? 's' : '' }}
                        </span>
                    @else
                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                        <span class="text-xs text-red-600 font-medium">Sin stock</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Botones de Acción --}}
        @if ($showActions)
            <div class="flex gap-2 mt-4">
                <button type="button"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 group"
                    {{ !$isInStock ? 'disabled' : '' }}
                    title="{{ $isInStock ? 'Agregar al carrito' : 'Producto agotado' }}">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span class="text-sm">{{ $isInStock ? 'Agregar' : 'Agotado' }}</span>
                </button>

                <button type="button"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-2.5 rounded-lg transition-colors duration-200"
                    title="Ver detalles">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>

{{-- JavaScript para el Slideshow Automático --}}
@if ($productImages->count() > 1)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slideshow = document.getElementById('{{ $slideshowId }}');
            if (!slideshow) return;

            const slides = slideshow.querySelectorAll('.slideshow-item');
            const indicators = slideshow.querySelectorAll('.slideshow-indicator');
            let currentSlide = 0;
            let slideInterval;

            function showSlide(index) {
                // Ocultar todas las slides
                slides.forEach(slide => {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                });

                // Actualizar indicadores
                indicators.forEach(indicator => {
                    indicator.classList.remove('bg-white');
                    indicator.classList.add('bg-white/50');
                });

                // Mostrar slide actual
                if (slides[index]) {
                    slides[index].classList.remove('opacity-0');
                    slides[index].classList.add('opacity-100');
                }

                // Actualizar indicador actual
                if (indicators[index]) {
                    indicators[index].classList.remove('bg-white/50');
                    indicators[index].classList.add('bg-white');
                }
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            function startSlideshow() {
                slideInterval = setInterval(nextSlide, 3000); // Cambiar cada 3 segundos
            }

            function stopSlideshow() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                }
            }

            // Pausar slideshow al hacer hover
            slideshow.addEventListener('mouseenter', stopSlideshow);
            slideshow.addEventListener('mouseleave', startSlideshow);

            // Iniciar slideshow automático
            startSlideshow();

            // Agregar click a indicadores para navegación manual
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function() {
                    currentSlide = index;
                    showSlide(currentSlide);
                    stopSlideshow();
                    startSlideshow(); // Reiniciar el timer
                });
            });
        });
    </script>
@endif
