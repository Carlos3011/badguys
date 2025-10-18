<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Editar producto') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.forms.input label="Nombre" name="name" :value="$product->name" required />
                        <x-admin.forms.input label="SKU" name="sku" :value="$product->sku" required />
                        <x-admin.forms.input label="Precio" name="price" type="number" step="0.01" :value="$product->price" />
                        <x-admin.forms.input label="Stock" name="stock" type="number" step="0.01" :value="$product->stock" />
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 font-montserrat mb-1">Estado</label>
                        @php
                            $stateChoices = \Vanilo\Product\Models\ProductStateProxy::choices();
                            $stateLabels = [
                                'draft' => 'Pendiente',
                                'inactive' => 'Inactivo',
                                'active' => 'Activo',
                                'unavailable' => 'No disponible',
                                'retired' => 'Retirado',
                            ];
                            $currentStateValue = $product->state->value();
                        @endphp
                        <select name="state" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                            @foreach($stateChoices as $value => $label)
                                <option value="{{ $value }}" @selected($currentStateValue === $value)>{{ $stateLabels[$value] ?? ucfirst($label) }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @php
                        $selectedCategory = optional($product->taxons->firstWhere('taxonomy_id', 1))->id;
                        $selectedBrand = optional($product->taxons->firstWhere('taxonomy_id', 2))->id;
                        $selectedSeason = optional($product->taxons->firstWhere('taxonomy_id', 3))->id;
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 font-montserrat mb-1">Categoría</label>
                            <select name="category" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                                <option value="">{{ __('Seleccione categoría') }}</option>
                                @foreach($categories as $taxon)
                                    <option value="{{ $taxon->id }}" @selected($selectedCategory == $taxon->id)>{{ $taxon->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 font-montserrat mb-1">Marca</label>
                            <select name="brand" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                                <option value="">{{ __('Seleccione marca') }}</option>
                                @foreach($brands as $taxon)
                                    <option value="{{ $taxon->id }}" @selected($selectedBrand == $taxon->id)>{{ $taxon->name }}</option>
                                @endforeach
                            </select>
                            @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 font-montserrat mb-1">Temporada</label>
                            <select name="season" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                                <option value="">{{ __('Seleccione temporada') }}</option>
                                @foreach($seasons as $taxon)
                                    <option value="{{ $taxon->id }}" @selected($selectedSeason == $taxon->id)>{{ $taxon->name }}</option>
                                @endforeach
                            </select>
                            @error('season')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ __('Imágenes actuales') }}</h3>
                        @php
                            $images = $product->getMedia('default');
                        @endphp
                        @if($images->count())
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($images as $img)
                                    <div class="relative group">
                                        <img src="{{ $img->getFullUrl() }}" alt="imagen" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 rounded-b-lg">
                                            <p class="truncate">{{ $img->file_name }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 font-montserrat">{{ __('Sin imágenes') }}</p>
                        @endif
                    </div>

                    <div>
                        <x-admin.forms.file-upload 
                            label="Nuevas imágenes (reemplazarán las actuales)" 
                            name="images" 
                            accept="image/*" 
                            :preview="true" 
                            :multiple="true"
                            :maxFiles="4"
                            help="Si subes nuevas imágenes, se reemplazarán todas las actuales."
                        />
                        @error('images')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Propiedades') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($properties as $property)
                                @php
                                    $pv = optional($product->propertyValues->firstWhere('property_id', $property->id))->value;
                                @endphp
                                <x-admin.forms.input
                                    :label="$property->name"
                                    :name="'properties['.$property->id.']'"
                                    :value="$pv"
                                    :placeholder="$property->type"
                                />
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>{{ __('Guardar cambios') }}</x-primary-button>
                        <x-admin.ui.button type="secondary" :href="route('admin.products.index')">{{ __('Cancelar') }}</x-admin.ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>