<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Productos') }}</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Productos')" :createHref="route('admin.products.create')" createLabel="Nuevo producto" />
            @if($products->count())
                <x-admin.ui.table :headers="['ID','Nombre','Categoría','Precio','Estado','Acciones']">
                    @foreach($products as $product)
                        @php
                            $category = optional($product->taxons->firstWhere('taxonomy_id', 1))->name ?? '-';
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $product->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $stateLabels = [
                                        'draft' => 'Pendiente',
                                        'inactive' => 'Inactivo',
                                        'active' => 'Activo',
                                        'unavailable' => 'No disponible',
                                        'retired' => 'Retirado',
                                    ];
                                    $state = $product->state->value();
                                    $badgeType = 'default';
                                    switch ($state) {
                                        case 'active':
                                            $badgeType = 'success';
                                            break;
                                        case 'draft':
                                            $badgeType = 'warning';
                                            break;
                                        case 'inactive':
                                        case 'retired':
                                            $badgeType = 'danger';
                                            break;
                                        case 'unavailable':
                                            $badgeType = 'default';
                                            break;
                                    }
                                @endphp
                                <x-admin.ui.badge :type="$badgeType">
                                    {{ $stateLabels[$state] ?? ucfirst($product->state->label()) }}
                                </x-admin.ui.badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-2">
                                    <x-admin.ui.button type="default" :href="route('admin.products.show', $product)">{{ __('Ver') }}</x-admin.ui.button>
                                    <x-admin.ui.button type="primary" :href="route('admin.products.edit', $product)">{{ __('Editar') }}</x-admin.ui.button>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('{{ __('¿Seguro que deseas eliminar este producto?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>{{ __('Eliminar') }}</x-danger-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <x-slot name="pagination">
                        {{ $products->links() }}
                    </x-slot>
                </x-admin.ui.table>
            @else
                <x-admin.ui.empty-state
                    icon="box"
                    title="Sin productos"
                    description="No hay productos para mostrar aún."
                    :actionHref="route('admin.products.create')"
                    actionLabel="Nuevo producto"
                />
            @endif
        </div>
    </div>
</x-admin-layout>