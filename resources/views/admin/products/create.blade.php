<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-plus-circle text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="font-roboto-flex text-2xl font-bold text-gray-900">{{ __('Crear Nuevo Producto') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 flex items-center gap-2">
                        <i class="fas fa-info-circle text-gray-400"></i>
                        Completa la información para agregar un producto al catálogo
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Información Básica -->
                <x-admin.forms.section 
                    title="Información Básica"
                    description="Datos principales del nuevo producto"
                    icon="fas fa-info-circle"
                    iconColor="blue">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.forms.input 
                            label="Nombre del Producto" 
                            name="name" 
                            placeholder="Ej: Camiseta Nike Pro"
                            icon="fas fa-tag"
                            help="Nombre descriptivo del producto"
                            required />

                        <x-admin.forms.input 
                            label="SKU" 
                            name="sku" 
                            placeholder="Ej: NK-PRO-001"
                            help="Código único de identificación"
                            icon="fas fa-barcode"
                            required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.forms.input 
                            label="Precio" 
                            name="price" 
                            type="number" 
                            step="0.01" 
                            placeholder="0.00"
                            help="Precio de venta al público"
                            icon="fas fa-dollar-sign" />

                        <x-admin.forms.input 
                            label="Stock Inicial" 
                            name="stock" 
                            type="number" 
                            step="0.01" 
                            placeholder="0"
                            help="Cantidad disponible en inventario"
                            icon="fas fa-cubes" />
                    </div>
                </x-admin.forms.section>

                <!-- Clasificación -->
                <x-admin.forms.section 
                    title="Clasificación"
                    description="Categoriza tu producto para facilitar su búsqueda"
                    icon="fas fa-sitemap"
                    iconColor="purple">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-admin.forms.select 
                            label="Categoría" 
                            name="category" 
                            :options="$categories->pluck('name', 'id')->toArray()"
                            placeholder="Seleccionar categoría"
                            icon="fas fa-th-large"
                            help="Tipo de producto" />

                        <x-admin.forms.select 
                            label="Marca" 
                            name="brand" 
                            :options="$brands->pluck('name', 'id')->toArray()"
                            placeholder="Seleccionar marca"
                            icon="fas fa-star"
                            help="Fabricante del producto" />

                        <x-admin.forms.select 
                            label="Temporada" 
                            name="season" 
                            :options="$seasons->pluck('name', 'id')->toArray()"
                            placeholder="Seleccionar temporada"
                            icon="fas fa-calendar-alt"
                            help="Período de disponibilidad" />
                    </div>
                </x-admin.forms.section>

                <!-- Imágenes -->
                <x-admin.forms.section 
                    title="Galería de Imágenes"
                    description="Agrega imágenes atractivas de tu producto (requerido)"
                    icon="fas fa-images"
                    iconColor="green">

                    <div class="flex items-start gap-3 mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <i class="fas fa-lightbulb text-blue-600 mt-0.5 text-lg"></i>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-900">Consejos para mejores resultados</p>
                            <ul class="text-xs text-blue-700 mt-2 space-y-1 list-disc list-inside">
                                <li>Usa imágenes de alta calidad (mínimo 800x800px)</li>
                                <li>Fondo blanco o neutro para mejor presentación</li>
                                <li>Muestra el producto desde diferentes ángulos</li>
                                <li>Primera imagen será la principal en el catálogo</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-dashed border-green-300 rounded-xl p-6 hover:border-green-400 transition-colors">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-green-600 text-2xl"></i>
                            </div>
                        </div>
                        <x-admin.forms.file-upload 
                            label="Subir Imágenes del Producto" 
                            name="images" 
                            accept="image/*" 
                            :preview="true" 
                            :multiple="true"
                            :maxFiles="4"
                            help="Formatos: JPG, PNG, WEBP, GIF | Tamaño máximo: 4MB por imagen | Mínimo 1 imagen requerida"
                        />
                    </div>

                    @error('images')
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                            <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-red-900">Error en las imágenes</p>
                                <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                    @error('images.*')
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                            <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-red-900">Error en formato de imagen</p>
                                <p class="text-xs text-red-700 mt-1">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                </x-admin.forms.section>

                <!-- Propiedades -->
                @if($properties->count())
                    <x-admin.forms.section 
                        title="Propiedades del Producto"
                        description="Características específicas y detalles técnicos (opcional)"
                        icon="fas fa-sliders-h"
                        iconColor="indigo">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($properties as $property)
                                @php
                                    $propertyIcons = [
                                        'color' => 'fas fa-palette',
                                        'talla' => 'fas fa-ruler',
                                        'size' => 'fas fa-ruler',
                                        'material' => 'fas fa-cube',
                                        'peso' => 'fas fa-weight',
                                        'weight' => 'fas fa-weight',
                                        'dimensiones' => 'fas fa-arrows-alt',
                                        'dimensions' => 'fas fa-arrows-alt',
                                    ];
                                    $iconClass = $propertyIcons[strtolower($property->name)] ?? 'fas fa-tag';
                                @endphp
                                <x-admin.forms.input
                                    :label="$property->name"
                                    :name="'properties['.$property->id.']'"
                                    :placeholder="'Ej: ' . $property->type"
                                    :icon="$iconClass"
                                />
                            @endforeach
                        </div>
                    </x-admin.forms.section>
                @endif

                <!-- Resumen del Formulario -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clipboard-check text-gray-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-2">Antes de guardar</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-600 text-xs"></i>
                                    Verifica que el nombre y SKU sean únicos
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-600 text-xs"></i>
                                    Asegúrate de haber subido al menos 1 imagen
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-600 text-xs"></i>
                                    Los campos marcados con <span class="text-red-600 font-bold">*</span> son obligatorios
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="sticky bottom-4 z-10">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white border-2 border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                                <i class="fas fa-times mr-2"></i>
                                Cancelar
                            </a>
                            
                            <div class="flex items-center gap-3">
                                <div class="hidden md:flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-plus-circle text-green-600"></i>
                                    <span>El producto se agregará al catálogo</span>
                                </div>
                                <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <i class="fas fa-save mr-2 text-lg"></i>
                                    Crear Producto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>