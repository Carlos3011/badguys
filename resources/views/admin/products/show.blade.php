<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-roboto-flex text-xl font-semibold text-gray-800">{{ __('Detalle del producto') }}</h2>
            <div class="flex gap-2">
                <x-admin.ui.button type="primary" :href="route('admin.products.edit', $product)">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    {{ __('Editar') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="secondary" :href="route('admin.products.index')">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Volver') }}
                </x-admin.ui.button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tabs de Navegación --}}
            <div class="mb-6 bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px" aria-label="Tabs">
                        <button type="button" 
                                onclick="switchTab('admin')" 
                                id="tab-admin"
                                class="tab-button w-1/3 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors duration-200 border-blue-500 text-blue-600">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Vista Administrativa
                        </button>
                        <button type="button" 
                                onclick="switchTab('card')" 
                                id="tab-card"
                                class="tab-button w-1/3 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                            </svg>
                            Card Cliente (Catálogo)
                        </button>
                        <button type="button" 
                                onclick="switchTab('detail')" 
                                id="tab-detail"
                                class="tab-button w-1/3 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Vista Detalle Cliente
                        </button>
                    </nav>
                </div>
            </div>

            {{-- Contenido de los Tabs --}}
            
            {{-- Vista Administrativa --}}
            <div id="content-admin" class="tab-content">
                <x-admin.ui.product.detail :product="$product" />
            </div>

            {{-- Vista Card Cliente --}}
            <div id="content-card" class="tab-content hidden">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Vista previa: Card de Catálogo</h3>
                        <p class="text-gray-600">Así es como los clientes verán este producto en el catálogo de la tienda</p>
                    </div>
                    <div class="max-w-sm mx-auto">
                        <x-customer.product.card :product="$product" :showActions="true" />
                    </div>
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500 italic">
                            💡 Esta es una vista previa interactiva de cómo se mostrará en la tienda
                        </p>
                    </div>
                </div>
            </div>

            {{-- Vista Detalle Cliente --}}
            <div id="content-detail" class="tab-content hidden">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Vista previa: Página de Detalle</h3>
                        <p class="text-gray-600">Así es como los clientes verán la página completa del producto</p>
                    </div>
                    <x-customer.product.detail-card :product="$product" />
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500 italic">
                            💡 Esta es la vista completa que verán los clientes al hacer clic en el producto
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal para ampliar imágenes --}}
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4" onclick="closeImageModal()">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Imagen ampliada" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
        </div>
    </div>
    <script>
        function switchTab(tabName) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Resetear estilos de todos los botones
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-blue-500', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });
            
            // Mostrar contenido seleccionado
            document.getElementById('content-' + tabName).classList.remove('hidden');
            
            // Activar botón seleccionado
            const activeButton = document.getElementById('tab-' + tabName);
            activeButton.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            activeButton.classList.add('border-blue-500', 'text-blue-600');
        }

        function openImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</x-admin-layout>