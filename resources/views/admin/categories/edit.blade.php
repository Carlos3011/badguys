<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Editar categoría') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    <x-admin.forms.input
                        label="{{ __('Nombre') }}"
                        name="name"
                        required
                        :value="$category->name"
                        placeholder="{{ __('Ej: Streetwear') }}"
                    />

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="taxonomy_id" class="block text-sm font-medium text-gray-700 font-montserrat mb-1">{{ __('Taxonomía') }}</label>
                            <select name="taxonomy_id" id="taxonomy_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                                @foreach($taxonomies as $taxonomy)
                                    <option value="{{ $taxonomy->id }}" {{ old('taxonomy_id', $category->taxonomy_id) == $taxonomy->id ? 'selected' : '' }}>
                                        {{ $taxonomy->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('taxonomy_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 font-montserrat mb-1">{{ __('Categoría padre') }}</label>
                            <select name="parent_id" id="parent_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black font-montserrat">
                                <option value="">{{ __('Sin padre') }}</option>
                                @foreach($taxons as $taxon)
                                    <option value="{{ $taxon->id }}" {{ old('parent_id', $category->parent_id) == $taxon->id ? 'selected' : '' }}>
                                        {{ $taxon->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-2">
                        <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
                        <x-admin.ui.button type="secondary" :href="route('admin.categories.index')">{{ __('Cancelar') }}</x-admin.ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>