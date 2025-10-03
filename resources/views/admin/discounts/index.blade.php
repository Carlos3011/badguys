<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Descuentos') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-admin.ui.index-toolbar :title="__('Descuentos')" :createHref="'#'" createLabel="Nuevo descuento" />

            @php
                $discounts = [
                    ['id' => 301, 'name' => 'Promo Verano', 'code' => 'VERANO20', 'type' => 'percent', 'value' => 20, 'is_active' => true],
                    ['id' => 302, 'name' => 'Cupón Bienvenida', 'code' => 'WELCOME10', 'type' => 'percent', 'value' => 10, 'is_active' => true],
                    ['id' => 303, 'name' => 'Descuento Fijo', 'code' => 'FIJO50', 'type' => 'fixed', 'value' => 50, 'is_active' => false],
                ];
            @endphp

            <x-admin.ui.table :headers="['ID','Nombre','Código','Tipo','Valor','Estado','Acciones']">
                @foreach($discounts as $discount)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $discount['id'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $discount['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $discount['code'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ ucfirst($discount['type']) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-montserrat text-gray-700">{{ $discount['value'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-admin.ui.badge :type="(($discount['is_active']) ? 'success' : 'danger')">
                                {{ ($discount['is_active']) ? 'Activo' : 'Inactivo' }}
                            </x-admin.ui.badge>
                        </td>
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