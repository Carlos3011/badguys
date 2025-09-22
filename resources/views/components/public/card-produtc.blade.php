@props([
    'title' => 'Producto',
    'description' => 'Descripción del producto',
    'price' => '$0.00',
    'icon' => 'fa-shirt',
    'category' => 'CATEGORÍA',
    'categoryDescription' => 'Descripción de categoría',
    'buttonText' => 'Agregar',
    'href' => '#'
])

<div class="bg-white rounded-2xl overflow-hidden border-2 border-gray-200 hover:border-black transition-colors duration-200">
    <!-- Sección superior con icono y categoría -->
    <div class="aspect-square bg-gray-50 flex items-center justify-center p-8">
        <div class="text-center">
            <!-- Icono del producto -->
            <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa {{ $icon }} text-3xl text-white"></i>
            </div>
            <!-- Categoría -->
            <h3 class="text-xl font-roboto-flex text-gray-800 mb-2">{{ $category }}</h3>
            <p class="text-gray-600 font-montserrat text-sm">{{ $categoryDescription }}</p>
        </div>
    </div>
    
    <!-- Sección inferior con información del producto -->
    <div class="p-6">
        <!-- Título del producto -->
        <h3 class="text-xl font-roboto-flex text-gray-900 mb-2">{{ $title }}</h3>
        
        <!-- Descripción del producto -->
        <p class="text-gray-600 mb-4 font-montserrat text-sm leading-relaxed">{{ $description }}</p>
        
        <!-- Precio y botón -->
        <div class="flex justify-between items-center">
            <span class="text-2xl font-bold text-black">{{ $price }}</span>
            <a href="{{ $href }}" class="bg-black hover:bg-gray-800 text-white px-5 py-2 rounded-lg font-semibold font-montserrat text-sm uppercase tracking-wide transition-colors duration-200 inline-block">
                {{ $buttonText }}
            </a>
        </div>
    </div>
</div>