@props(['products','cardSize'=>'default','showActions'=>false,'showQuickView'=>false,'class'=>null])

<div class="{{ $class ?? 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6' }}">
    @forelse($products as $product)
        <x-customer.product.card :product="$product" :showActions="$showActions" :showQuickView="$showQuickView" :cardSize="$cardSize" class="bg-white border border-black grayscale" />
    @empty
        <div class="col-span-full text-center text-black">{{ __('No hay productos disponibles.') }}</div>
    @endforelse
    </div>
<div class="mt-8">
    {{ $products->links() }}
</div>