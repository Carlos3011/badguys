<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Crear producto') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="post" action="#" enctype="multipart/form-data">
                    @csrf

                    <x-admin.forms.input label="Nombre" name="name" placeholder="Nombre del producto" required />
                    <x-admin.forms.input label="SKU" name="sku" placeholder="SKU del producto" />
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.forms.input label="Precio" name="price" type="number" step="0.01" placeholder="0.00" />
                        <x-admin.forms.input label="Stock" name="stock" type="number" step="1" placeholder="0" />
                    </div>

                    <x-admin.forms.select label="Categoría" name="category_id" :options="[['value'=>1,'label'=>'Ropa'],['value'=>2,'label'=>'Accesorios']]" placeholder="Seleccione una categoría" />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.forms.toggle label="Activo" name="is_active" checked="true" />
                        <x-admin.forms.toggle label="Destacado" name="is_featured" />
                    </div>

                    <x-admin.forms.textarea label="Descripción" name="description" placeholder="Describe tu producto" rows="5" />

                    <x-admin.forms.file-upload label="Imagen principal" name="main_image" />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-admin.forms.date-picker label="Inicio promo" name="promo_start" />
                        <x-admin.forms.date-picker label="Fin promo" name="promo_end" />
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <x-admin.ui.button type="secondary" href="{{ route('admin.products.index') }}">{{ __('Cancelar') }}</x-admin.ui.button>
                        <x-admin.ui.button type="primary">{{ __('Guardar') }}</x-admin.ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>