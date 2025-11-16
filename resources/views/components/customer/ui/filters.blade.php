@props(['categories'=>collect(), 'selectedCategory'=>null, 'sort'=>null])

<div class="flex items-center justify-between gap-4">
    <div class="flex items-center gap-2 flex-wrap">
        <a href="?{{ http_build_query(array_merge(request()->except('page'), ['category'=>null])) }}" class="px-3 py-1 text-sm rounded-md {{ request('category') ? 'bg-white text-black border border-black' : 'bg-black text-white' }}">Todas</a>
        @foreach($categories as $cat)
            <a href="?{{ http_build_query(array_merge(request()->except('page'), ['category'=>$cat->id])) }}" class="px-3 py-1 text-sm rounded-md {{ (int)request('category') === $cat->id ? 'bg-black text-white' : 'bg-white text-black border border-black' }}">{{ $cat->name }}</a>
        @endforeach
    </div>
    <div>
        <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2">
            @foreach(request()->except(['sort','page']) as $key=>$val)
                <input type="hidden" name="{{ $key }}" value="{{ $val }}" />
            @endforeach
            <div class="relative">
                <select name="sort" class="appearance-none bg-white border border-black rounded-md px-3 py-2 pr-10 text-sm text-black">
                    <option value="newest" {{ request('sort')==='newest' ? 'selected' : '' }}>Nuevos</option>
                    <option value="price_asc" {{ request('sort')==='price_asc' ? 'selected' : '' }}>Precio ↑</option>
                    <option value="price_desc" {{ request('sort')==='price_desc' ? 'selected' : '' }}>Precio ↓</option>
                </select>
                <i class="fas fa-sort absolute right-3 top-1/2 -translate-y-1/2 text-black"></i>
            </div>
            <button class="px-3 py-2 bg-black text-white rounded-md inline-flex items-center gap-2"><i class="fas fa-check"></i><span>Aplicar</span></button>
        </form>
    </div>
</div>