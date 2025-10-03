<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Pedidos') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Pedidos')" :createHref="'#'" createLabel="Nuevo pedido" />

            @php
                $orders = [
                    ['id' => 101, 'customer' => ['name' => 'Juan Pérez'], 'total' => 59.99, 'status' => 'completed'],
                    ['id' => 102, 'customer' => ['name' => 'María García'], 'total' => 24.50, 'status' => 'pending'],
                    ['id' => 103, 'customer' => ['name' => 'Carlos López'], 'total' => 120.00, 'status' => 'shipped'],
                ];
            @endphp

            <x-admin.ui.table :headers="['ID','Cliente','Total','Estado','Acciones']">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $order['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $order['customer']['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">${{ number_format($order['total'], 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-admin.ui.badge :type="(($order['status']) === 'completed' ? 'success' : 'warning')">
                                {{ ucfirst($order['status']) }}
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