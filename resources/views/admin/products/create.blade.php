<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Crear producto') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-admin.forms.input label="Nombre" name="name" required />
                        <x-admin.forms.input label="SKU" name="sku" required />
                        <x-admin.forms.input label="Precio" name="price" type="number" step="0.01" />
                        <x-admin.forms.input label="Stock" name="stock" type="number" step="0.01" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 font-montserrat mb-1">Categoría</label>
                            <select name="category" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                                <option value="">{{ __('Seleccione categoría') }}</option>
                                @foreach($categories as $taxon)
                                    <option value="{{ $taxon->id }}">{{ $taxon->name }}</option>
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
                                    <option value="{{ $taxon->id }}">{{ $taxon->name }}</option>
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
                                    <option value="{{ $taxon->id }}">{{ $taxon->name }}</option>
                                @endforeach
                            </select>
                            @error('season')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Propiedades') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($properties as $property)
                                <x-admin.forms.input
                                    :label="$property->name"
                                    :name="'properties['.$property->id.']'"
                                    :placeholder="$property->type"
                                />
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <x-admin.forms.file-upload label="Imágenes" name="images[]" accept="image/*" :preview="true" multiple />
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div id="create-images-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2"></div>
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                        <x-admin.ui.button type="secondary" :href="route('admin.products.index')">{{ __('Cancelar') }}</x-admin.ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('input[name="images[]"]');
            const preview = document.getElementById('create-images-preview');
            if (input && preview) {
                input.addEventListener('change', function(e) {
                    preview.innerHTML = '';
                    Array.from(e.target.files).forEach(file => {
                        const url = URL.createObjectURL(file);
                        const img = document.createElement('img');
                        img.src = url;
                        img.alt = 'preview';
                        img.className = 'w-full h-32 object-cover rounded-lg border';
                        preview.appendChild(img);
                    });
                });
            }
        });
    </script>
</x-admin-layout>