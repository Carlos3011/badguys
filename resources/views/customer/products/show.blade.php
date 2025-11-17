<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3">
                    <div class="bg-white border border-black rounded-lg p-6">
                        <x-customer.product.detail-card :product="$product" :showRelated="false" :showReviews="false" layout="default" />
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <x-customer.product.related :product="$product" :limit="8" title="Productos similares" orientation="sidebar" />
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>