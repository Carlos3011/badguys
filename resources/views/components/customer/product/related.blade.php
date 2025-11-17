@props(['product','limit'=>6,'title'=>'Productos similares','orientation'=>'grid'])

@php
    $category = $product->taxons->firstWhere('taxonomy_id', 1);
    $brand = $product->taxons->firstWhere('taxonomy_id', 2);
    $query = \App\Models\Product::query()
        ->with(['taxons','media'])
        ->where('state','active')
        ->where('id','!=',$product->id);

    if($category){
        $query->whereHas('taxons', function($tax) use($category){ $tax->where('id', $category->id); });
    }
    if($brand){
        $query->orWhereHas('taxons', function($tax) use($brand){ $tax->where('id', $brand->id); });
    }

    $similar = $query->orderBy('created_at','desc')->limit($limit)->get();
    if($similar->count() === 0){
        $similar = \App\Models\Product::query()
            ->with(['taxons','media'])
            ->where('state','active')
            ->where('id','!=',$product->id)
            ->orderBy('created_at','desc')
            ->limit($limit)
            ->get();
    }
@endphp

@php
    $containerClasses = $orientation === 'sidebar' ? 'lg:sticky lg:top-6' : 'mt-12';
    $gridClasses = $orientation === 'sidebar' ? 'grid grid-cols-1 gap-4' : 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6';
@endphp

<div class="{{ $containerClasses }}">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-gray-900">{{ $title }}</h3>
        <a href="{{ route('customer.products.index') }}" class="text-sm text-black hover:underline">Ver todos</a>
    </div>
    <div class="{{ $gridClasses }}">
        @foreach($similar as $item)
            <x-customer.product.card :product="$item" :showActions="false" :showQuickView="false" cardSize="small" class="bg-white border border-black" />
        @endforeach
    </div>
</div>