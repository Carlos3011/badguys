<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Categorías') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Categorías')" :createHref="route('admin.categories.create')" createLabel="Nueva categoría" />

            

            <x-admin.ui.table :headers="['ID','Nombre','Slug','Acciones']">
                @foreach($taxons as $taxon)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $taxon->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $taxon->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $taxon->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="inline-flex items-center gap-2">
                                <x-admin.ui.button type="default" :href="route('admin.categories.edit', $taxon)">{{ __('Editar') }}</x-admin.ui.button>
                                <form method="POST" action="{{ route('admin.categories.destroy', $taxon) }}" class="inline" onsubmit="return confirm('{{ __('¿Seguro que deseas eliminar esta categoría?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>{{ __('Eliminar') }}</x-danger-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-admin.ui.table>
        </div>
    </div>
</x-admin-layout>