@props([
    'icon' => 'box',
    'title' => 'Sin registros',
    'description' => 'No hay elementos para mostrar aún.',
    'actionHref' => null,
    'actionLabel' => 'Crear nuevo',
])

<div class="bg-white rounded-lg shadow p-12 text-center">
    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-gray-100 rounded-full">
        <x-admin.ui.icon :name="$icon" class="text-2xl text-gray-600" />
    </div>
    <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
    <p class="text-gray-500 mt-2">{{ $description }}</p>
    @if($actionHref)
        <div class="mt-6">
            <x-admin.ui.button type="primary" :href="$actionHref">
                <x-admin.ui.icon name="plus" class="mr-2" />{{ $actionLabel }}
            </x-admin.ui.button>
        </div>
    @endif
</div>