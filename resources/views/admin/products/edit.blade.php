<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="font-roboto-flex text-2xl font-bold text-gray-900">{{ __('Editar Producto') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 flex items-center gap-2">
                        <i class="fas fa-box text-gray-400"></i>
                        {{ $product->name }}
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
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Información Básica -->
                <x-admin.forms.section 
                    title="Información Básica"
                    description="Datos principales del producto"
                    icon="fas fa-info-circle"
                    iconColor="blue">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.forms.input 
                            label="Nombre del Producto" 
                            name="name" 
                            :value="$product->name" 
                            placeholder="Ej: Camiseta Nike Pro"
                            icon="fas fa-tag"
                            required />

                        <x-admin.forms.input 
                            label="SKU" 
                            name="sku" 
                            :value="$product->sku"
                            placeholder="Ej: NK-PRO-001"
                            help="Código único de identificación"
                            icon="fas fa-barcode"
                            required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-admin.forms.input 
                            label="Precio" 
                            name="price" 
                            type="number" 
                            step="0.01" 
                            :value="$product->price"
                            placeholder="0.00"
                            icon="fas fa-dollar-sign" />

                        <x-admin.forms.input 
                            label="Stock Disponible" 
                            name="stock" 
                            type="number" 
                            step="0.01" 
                            :value="$product->stock"
                            placeholder="0"
                            icon="fas fa-cubes" />

                        @php
                            $stateChoices = \Vanilo\Product\Models\ProductStateProxy::choices();
                            $stateLabels = [
                                'draft' => 'Pendiente',
                                'inactive' => 'Inactivo',
                                'active' => 'Activo',
                                'unavailable' => 'No disponible',
                                'retired' => 'Retirado',
                            ];
                            $stateOptions = collect($stateChoices)->mapWithKeys(function($label, $value) use ($stateLabels) {
                                return [$value => $stateLabels[$value] ?? ucfirst($label)];
                            });
                        @endphp

                        <x-admin.forms.select 
                            label="Estado" 
                            name="state" 
                            :options="$stateOptions->toArray()"
                            :selected="$product->state->value()"
                            placeholder="Seleccionar estado"
                            icon="fas fa-toggle-on" />
                    </div>
                </x-admin.forms.section>

                <!-- Clasificación -->
                <x-admin.forms.section 
                    title="Clasificación"
                    description="Categoriza tu producto para facilitar su búsqueda"
                    icon="fas fa-sitemap"
                    iconColor="purple">

                    @php
                        $selectedCategory = optional($product->taxons->firstWhere('taxonomy_id', 1))->id;
                        $selectedBrand = optional($product->taxons->firstWhere('taxonomy_id', 2))->id;
                        $selectedSeason = optional($product->taxons->firstWhere('taxonomy_id', 3))->id;
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <x-admin.forms.select 
                            label="Categoría" 
                            name="category" 
                            :options="$categories->pluck('name', 'id')->toArray()"
                            :selected="$selectedCategory"
                            placeholder="Seleccionar categoría"
                            icon="fas fa-th-large" />

                        <x-admin.forms.select 
                            label="Marca" 
                            name="brand" 
                            :options="$brands->pluck('name', 'id')->toArray()"
                            :selected="$selectedBrand"
                            placeholder="Seleccionar marca"
                            icon="fas fa-star" />

                        <x-admin.forms.select 
                            label="Temporada" 
                            name="season" 
                            :options="$seasons->pluck('name', 'id')->toArray()"
                            :selected="$selectedSeason"
                            placeholder="Seleccionar temporada"
                            icon="fas fa-calendar-alt" />
                    </div>
                </x-admin.forms.section>

                <!-- Imágenes -->
                <x-admin.forms.section 
                    title="Galería de Imágenes"
                    description="Gestiona las imágenes del producto (máximo 4 imágenes)"
                    icon="fas fa-images"
                    iconColor="green">

                    @if($product->hasImages())
                        <div class="mb-6">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 text-sm"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-gray-700">
                                    Imágenes Actuales ({{ $product->getMedia('default')->count() }})
                                </h4>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach($product->getMedia('default') as $img)
                                    <div class="group relative">
                                        <x-admin.ui.product-image 
                                            :media="$img"
                                            class="w-full h-32 object-cover rounded-lg border-2 border-gray-200 group-hover:border-green-400 transition-all duration-200"
                                        />
                                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center shadow-lg">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex items-start gap-3 mb-4 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                                <i class="fas fa-exclamation-triangle text-amber-600 mt-0.5"></i>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-amber-900">Importante</p>
                                    <p class="text-xs text-amber-700 mt-1">Si subes nuevas imágenes, se reemplazarán TODAS las imágenes actuales del producto.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-dashed border-blue-300 rounded-xl p-6 hover:border-blue-400 transition-colors">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                        <x-admin.forms.file-upload 
                            label="Subir Nuevas Imágenes" 
                            name="images" 
                            accept="image/*" 
                            :preview="true" 
                            :multiple="true"
                            :maxFiles="4"
                            help="Formatos: JPG, PNG, WEBP, GIF | Tamaño máximo: 4MB por imagen"
                        />
                    </div>
                </x-admin.forms.section>

                <!-- Propiedades -->
                @if($properties->count())
                    <x-admin.forms.section 
                        title="Propiedades del Producto"
                        description="Características específicas y detalles técnicos"
                        icon="fas fa-sliders-h"
                        iconColor="indigo">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($properties as $property)
                                @php
                                    $pv = optional($product->propertyValues->firstWhere('property_id', $property->id))->value;
                                    $propertyIcons = [
                                        'color' => 'fas fa-palette',
                                        'talla' => 'fas fa-ruler',
                                        'material' => 'fas fa-cube',
                                        'peso' => 'fas fa-weight',
                                    ];
                                    $iconClass = $propertyIcons[strtolower($property->name)] ?? 'fas fa-info-circle';
                                @endphp
                                <x-admin.forms.input
                                    :label="$property->name"
                                    :name="'properties['.$property->id.']'"
                                    :value="$pv"
                                    :placeholder="'Ingrese ' . strtolower($property->name)"
                                    :icon="$iconClass"
                                />
                            @endforeach
                        </div>
                    </x-admin.forms.section>
                @endif

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
                                    <i class="fas fa-save text-blue-600"></i>
                                    <span>Los cambios se guardarán permanentemente</span>
                                </div>
                                <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <i class="fas fa-check-circle mr-2 text-lg"></i>
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>