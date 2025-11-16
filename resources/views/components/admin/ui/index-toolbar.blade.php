@props([
    'title' => null,
    'createHref' => null,
    'createLabel' => 'Crear',
    'showSearch' => true,
    'searchPlaceholder' => 'Buscar...',
])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-4 rounded-lg shadow">
    <div class="flex items-center gap-2">
        @if($title)
            <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        @endif
        {{ $title ? '' : $slot }}
    </div>

    <div class="flex items-center gap-3">
        @if($showSearch)
            <form method="GET" action="{{ url()->current() }}" class="relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ $searchPlaceholder }}" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg font-montserrat text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent">
                <x-admin.ui.icon name="search" variant="solid" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
            </form>
        @endif

        {{ $filters ?? '' }}

        @if($createHref)
            <x-admin.ui.button type="primary" :href="$createHref">
                <x-admin.ui.icon name="plus" class="mr-2" />{{ $createLabel }}
            </x-admin.ui.button>
        @endif
    </div>
</div>