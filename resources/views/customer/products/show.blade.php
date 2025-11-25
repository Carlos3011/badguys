<x-customer-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8">
                <div>
                    <div class="bg-white rounded-lg p-6">
                        <x-customer.product.detail-card :product="$product" :showRelated="false" :showReviews="false" layout="default" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>