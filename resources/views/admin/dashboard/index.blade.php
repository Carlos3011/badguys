<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Bienvenida -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-montserrat">
                    {{ __('Bienvenido al panel, aquí tienes un ejemplo de tabla reutilizable.') }}
                </div>
            </div>

            <!-- Tabla reutilizable: Últimos pedidos -->
            <x-admin.ui.table
                title="{{ __('Últimos pedidos') }}"
                description="{{ __('Resumen de los pedidos recientes') }}"
                :striped="true"
                :bordered="true"
                :hover="true"
            >
                <x-slot:actions>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm bg-black text-white rounded-lg hover:bg-gray-800">{{ __('Ver todos') }}</a>
                </x-slot:actions>

                <x-slot:columns>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">{{ __('Cliente') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">{{ __('Estado') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">{{ __('Total') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">{{ __('Fecha') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">{{ __('Acciones') }}</th>
                    </tr>
                </x-slot:columns>

                <x-slot:rows>
                    @php
                        $items = [
                            ['id' => '1001', 'customer' => 'John Doe', 'status' => 'Pagado', 'total' => '$149.90', 'date' => '2025-10-02'],
                            ['id' => '1002', 'customer' => 'Jane Smith', 'status' => 'Pendiente', 'total' => '$89.50', 'date' => '2025-10-03'],
                            ['id' => '1003', 'customer' => 'Carlos Ruiz', 'status' => 'Enviado', 'total' => '$239.00', 'date' => '2025-10-03'],
                        ];
                    @endphp

                    @foreach($items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $item['id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $item['customer'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-md
                                    @class([
                                        'bg-green-100 text-green-800' => $item['status'] === 'Pagado',
                                        'bg-yellow-100 text-yellow-800' => $item['status'] === 'Pendiente',
                                        'bg-blue-100 text-blue-800' => $item['status'] === 'Enviado',
                                    ])
                                ">{{ $item['status'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $item['total'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $item['date'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="#" class="text-sm text-black bg-white border border-gray-300 px-3 py-1 rounded-lg hover:bg-gray-50">{{ __('Ver') }}</a>
                                    <a href="#" class="text-sm text-white bg-black px-3 py-1 rounded-lg hover:bg-gray-800">{{ __('Editar') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:rows>

                <x-slot:pagination>
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600 font-montserrat">{{ __('Mostrando 1-3 de 3') }}</p>
                        <div class="inline-flex gap-2">
                            <button class="px-3 py-1 text-sm bg-white border border-gray-300 rounded-lg hover:bg-gray-50">{{ __('Anterior') }}</button>
                            <button class="px-3 py-1 text-sm bg-black text-white rounded-lg hover:bg-gray-800">{{ __('Siguiente') }}</button>
                        </div>
                    </div>
                </x-slot:pagination>
            </x-admin.ui.table>
        </div>
    </div>
</x-admin-layout>