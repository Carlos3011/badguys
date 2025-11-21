{{--
    Componente: Product Card
    Ubicación: resources/views/components/customer/product/card.blade.php
    
    Props:
    - product (required): Instancia del modelo Product
    - showActions (optional, default: false): Mostrar botón de agregar al carrito
    - showQuickView (optional, default: false): Mostrar botón de vista rápida
    - cardSize (optional, default: 'default'): Tamaño de la card ('small', 'default', 'large')
--}}

@props(['product', 'showActions' => false, 'showQuickView' => false, 'cardSize' => 'default', 'showOnlyName' => false])

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

<a href="{{ route('customer.products.show', $product) }}"
    {{ $attributes->merge(['class' => 'block cursor-pointer ' . $size['container']]) }}>

    {{-- Contenedor de Imagen con Slideshow --}}
    <div class="relative {{ $size['image'] }} overflow-hidden">

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
        <div class="absolute top-3 left-3 right-3 flex justify-between items-start gap-2 z-30 hidden">
            <div class="flex flex-col gap-2">
                {{-- Badge de Estado Borrador --}}
                @if ($isDraft)
                    <span class="inline-flex items-center gap-1 bg-yellow-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                        <i class="fas fa-clock text-xs"></i>
                        Borrador
                    </span>
                @endif

                {{-- Badge de Stock Bajo --}}
                @if ($isLowStock)
                    <span class="inline-flex items-center gap-1 bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg animate-pulse">
                        <i class="fas fa-exclamation-triangle text-xs"></i>
                        ¡{{ $stock }} {{ Str::plural('unidad', $stock) }}!
                    </span>
                @endif

                {{-- Badge de Agotado --}}
                @if ($isOutOfStock)
                    <span class="inline-flex items-center gap-1 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                        <i class="fas fa-ban text-xs"></i>
                        Agotado
                    </span>
                @endif
            </div>

            {{-- Botón de Favoritos --}}
            <button type="button"
                class="bg-white/90 backdrop-blur-sm hover:bg-white text-gray-700 hover:text-red-500 p-2 rounded-full shadow-lg transition-all duration-200 opacity-0 group-hover:opacity-100"
                title="Agregar a favoritos">
                <i class="fas fa-heart"></i>
            </button>
        </div>

        {{-- Botón de Vista Rápida (opcional) --}}
        @if ($showQuickView)
            <div
                class="absolute bottom-3 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-30 {{ $productImages->count() > 1 ? 'mb-8' : '' }} hidden">
                <button type="button" class="bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-2 transition-colors duration-200">
                    <i class="fas fa-eye"></i>
                    Vista Rápida
                </button>
            </div>
        @endif
    </div>

    {{-- Contenido de la Card --}}
    <div class="{{ $size['padding'] }} {{ $showOnlyName ? '' : 'hidden' }}">

        @if (!$showOnlyName)
        <div class="flex items-center gap-2 text-xs mb-2 flex-wrap">
            @if ($category)
                <span class="inline-flex items-center bg-blue-50 text-blue-700 px-2 py-1 rounded-md font-medium">
                    <i class="fas fa-tags text-xs mr-1"></i>
                    {{ $category->name }}
                </span>
            @endif

            @if ($brand)
                <span class="inline-flex items-center bg-gray-100 text-gray-700 px-2 py-1 rounded-md font-medium">
                    <i class="fas fa-tag text-xs mr-1"></i>
                    {{ $brand->name }}
                </span>
            @endif

            @if ($season)
                <span class="inline-flex items-center bg-green-50 text-green-700 px-2 py-1 rounded-md font-medium">
                    <i class="fas fa-leaf text-xs mr-1"></i>
                    {{ $season->name }}
                </span>
            @endif
        </div>
        @endif

        {{-- Nombre del Producto --}}
        <a href="{{ route('customer.products.show', $product) }}">
            <h3
                class="font-roboto-flex {{ $size['title'] }} font-semibold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem] leading-tight hover:text-black transition-colors cursor-pointer">
                {{ $product->name }}
            </h3>
        </a>

        @if (!$showOnlyName && $product->excerpt)
            <p class="text-sm text-gray-600 mb-3 line-clamp-2 leading-relaxed">
                {{ $product->excerpt }}
            </p>
        @endif

        @if (!$showOnlyName)
        <div class="text-xs text-gray-400 mb-3 font-mono">
            SKU: {{ $product->sku }}
        </div>
        @endif

        @if (!$showOnlyName)
        <div class="border-t border-gray-100 my-3"></div>
        @endif

        @if (!$showOnlyName)
        <div class="flex items-end justify-between mb-3">
            <div>
                <div class="flex items-baseline gap-1">
                    <span class="{{ $size['price'] }} font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </span>
                    <span class="text-sm text-gray-500 font-medium">USD</span>
                </div>

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
        @endif

        @if (!$showOnlyName && $showActions)
            <div class="flex gap-2 mt-4">
                <button type="button" class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white font-semibold py-2.5 px-4 rounded-lg transition-all duración-200 flex items-center justify-center gap-2 group" {{ !$isInStock ? 'disabled' : '' }} title="{{ $isInStock ? 'Agregar al carrito' : 'Producto agotado' }}">
                    <i class="fas fa-shopping-cart group-hover:scale-110 transition-transform"></i>
                    <span class="text-sm">{{ $isInStock ? 'Agregar' : 'Agotado' }}</span>
                </button>

                <a href="{{ route('customer.products.show', $product) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-2.5 rounded-lg transition-colors duration-200" title="Ver detalles">
                    <i class="fas fa-info-circle"></i>
                </a>
            </div>
        @endif
    </div>
</a>

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
