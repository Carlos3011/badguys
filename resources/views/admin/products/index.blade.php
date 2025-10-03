<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Productos') }}</h2>
    </x-slot>

    @php
        $products = [
            [
                'id' => 1,
                'name' => 'Camiseta BadGuys Negra',
                'category' => ['name' => 'Ropa'],
                'price' => 19.99,
                'stock' => 120,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Sudadera BadGuys',
                'category' => ['name' => 'Ropa'],
                'price' => 34.50,
                'stock' => 45,
                'is_active' => false,
            ],
            [
                'id' => 3,
                'name' => 'Gorra BadGuys',
                'category' => ['name' => 'Accesorios'],
                'price' => 12.00,
                'stock' => 200,
                'is_active' => true,
            ],
        ];
    @endphp

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Productos')" :createHref="'#'" createLabel="Nuevo producto" />
            <x-admin.ui.table :headers="['ID','Nombre','Categoría','Precio','Stock','Estado','Acciones']">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $product['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $product['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $product['category']['name'] ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">${{ number_format($product['price'], 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $product['stock'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-admin.ui.badge :type="($product['is_active'] ? 'success' : 'danger')">
                                {{ $product['is_active'] ? 'Activo' : 'Inactivo' }}
                            </x-admin.ui.badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="inline-flex items-center gap-2">
                                <x-admin.ui.button type="primary" href="#">{{ __('Editar') }}</x-admin.ui.button>
                                <x-admin.ui.dropdown align="right">
                                    <x-slot name="trigger">
                                        <x-admin.ui.button type="default">{{ __('Más') }}</x-admin.ui.button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Ver') }}</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-red-700 hover:bg-red-50">{{ __('Eliminar') }}</a>
                                    </x-slot>
                                </x-admin.ui.dropdown>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-admin.ui.table>
        </div>
    </div>
</x-admin-layout>