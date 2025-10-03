<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Categorías') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Categorías')" :createHref="'#'" createLabel="Nueva categoría" />

            @php
                $categories = [
                    ['id' => 1, 'name' => 'Ropa', 'slug' => 'ropa'],
                    ['id' => 2, 'name' => 'Accesorios', 'slug' => 'accesorios'],
                    ['id' => 3, 'name' => 'Coleccionables', 'slug' => 'coleccionables'],
                ];
            @endphp

            <x-admin.ui.table :headers="['ID','Nombre','Slug','Acciones']">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $category['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $category['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $category['slug'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="inline-flex items-center gap-2">
                                <x-admin.ui.button type="default" href="#">{{ __('Editar') }}</x-admin.ui.button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-admin.ui.table>
        </div>
    </div>
</x-admin-layout>