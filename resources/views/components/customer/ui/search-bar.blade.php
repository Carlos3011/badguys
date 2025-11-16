@props(['action'=>null,'placeholder'=>'Buscar productos','q'=>null])

<form method="GET" action="{{ $action ?? url()->current() }}" class="flex items-center gap-3">
    <input type="text" name="q" value="{{ $q ?? request('q') }}" class="w-full md:w-96 bg-white border border-black rounded-md px-4 py-2 text-black placeholder-black/50" placeholder="{{ $placeholder }}" />
    <button type="submit" class="px-4 py-2 bg-black text-white rounded-md">Buscar</button>
</form>