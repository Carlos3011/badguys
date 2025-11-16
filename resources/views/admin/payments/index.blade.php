<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Pagos') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Pagos')" :createHref="'#'" createLabel="Nuevo pago" />

            @php
                $payments = [
                    ['id' => 501, 'order_id' => 101, 'total' => 59.99, 'method' => 'card', 'status' => 'paid'],
                    ['id' => 502, 'order_id' => 102, 'total' => 24.50, 'method' => 'cash', 'status' => 'pending'],
                    ['id' => 503, 'order_id' => 103, 'total' => 120.00, 'method' => 'transfer', 'status' => 'paid'],
                ];
            @endphp

            <x-admin.ui.table :headers="['ID','Pedido','Total','Método','Estado','Acciones']">
                @foreach($payments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $payment['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">#{{ $payment['order_id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">${{ number_format($payment['total'], 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ ucfirst($payment['method']) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-admin.ui.badge :type="(($payment['status']) === 'paid' ? 'success' : 'warning')">
                                {{ ucfirst($payment['status']) }}
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