<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Clientes') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Clientes')" :createHref="'#'" createLabel="Nuevo cliente" />

            @php
                $customers = [
                    ['id' => 1, 'name' => 'Juan Pérez', 'email' => 'juan@example.com', 'is_active' => true],
                    ['id' => 2, 'name' => 'María García', 'email' => 'maria@example.com', 'is_active' => false],
                    ['id' => 3, 'name' => 'Carlos López', 'email' => 'carlos@example.com', 'is_active' => true],
                ];
            @endphp

            <x-admin.ui.table :headers="['ID','Nombre','Email','Estado','Acciones']">
                @foreach($customers as $customer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $customer['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $customer['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $customer['email'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-admin.ui.badge :type="($customer['is_active'] ? 'success' : 'danger')">
                                {{ $customer['is_active'] ? 'Activo' : 'Inactivo' }}
                            </x-admin.ui.badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="inline-flex items-center gap-2">
                                <x-admin.ui.button type="default" href="#">{{ __('Ver') }}</x-admin.ui.button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-admin.ui.table>
        </div>
    </div>
</x-admin-layout>