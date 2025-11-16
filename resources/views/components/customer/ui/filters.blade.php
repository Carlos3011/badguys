@props(['categories'=>collect(), 'selectedCategory'=>null, 'sort'=>null])

<div class="flex items-center justify-between gap-4">
    <div class="flex items-center gap-2 flex-wrap">
        <a href="?{{ http_build_query(array_merge(request()->except('page'), ['category'=>null])) }}" class="px-3 py-1 text-sm rounded-md inline-flex items-center gap-1 {{ request('category') ? 'bg-white text-black border border-black' : 'bg-black text-white' }}">
            <i class="fas fa-layer-group text-xs"></i>
            <span>Todas</span>
        </a>
        @foreach($categories as $cat)
            <a href="?{{ http_build_query(array_merge(request()->except('page'), ['category'=>$cat->id])) }}" class="px-3 py-1 text-sm rounded-md inline-flex items-center gap-1 {{ (int)request('category') === $cat->id ? 'bg-black text-white' : 'bg-white text-black border border-black' }}">
                <i class="fas fa-tag text-xs"></i>
                <span>{{ $cat->name }}</span>
            </a>
        @endforeach
    </div>
    <div>
        @php($qs = request()->except('page'))
        @php($currentSort = request('sort','newest'))
        @php($sortMap = ['newest' => ['label' => 'Nuevos', 'icon' => 'fas fa-clock'], 'price_asc' => ['label' => 'Precio ↑', 'icon' => 'fas fa-sort-amount-up'], 'price_desc' => ['label' => 'Precio ↓', 'icon' => 'fas fa-sort-amount-down']])

        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md bg-white border border-black text-black hover:bg-black hover:text-white transition">
                    <i class="{{ $sortMap[$currentSort]['icon'] }} mr-2"></i>
                    <span>Ordenar: {{ $sortMap[$currentSort]['label'] }}</span>
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
            </x-slot>

            <x-slot name="content">
                <a href="?{{ http_build_query(array_merge($qs, ['sort'=>'newest'])) }}" class="block px-4 py-2 text-black hover:bg-black hover:text-white">
                    <i class="fas fa-clock mr-2"></i> Nuevos
                </a>
                <a href="?{{ http_build_query(array_merge($qs, ['sort'=>'price_asc'])) }}" class="block px-4 py-2 text-black hover:bg-black hover:text-white">
                    <i class="fas fa-sort-amount-up mr-2"></i> Precio ↑
                </a>
                <a href="?{{ http_build_query(array_merge($qs, ['sort'=>'price_desc'])) }}" class="block px-4 py-2 text-black hover:bg-black hover:text-white">
                    <i class="fas fa-sort-amount-down mr-2"></i> Precio ↓
                </a>
            </x-slot>
        </x-dropdown>
    </div>
</div>