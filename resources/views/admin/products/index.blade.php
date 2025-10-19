<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-box text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="font-roboto-flex text-2xl font-bold text-gray-900">{{ __('Gestión de Productos') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 flex items-center gap-2">
                        <i class="fas fa-database text-gray-400"></i>
                        {{ $products->total() }} productos en total
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-plus-circle mr-2 text-lg"></i>
                Nuevo Producto
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($products->count())
                <x-admin.ui.table 
                    title="Lista de Productos"
                    description="Gestiona tu catálogo de productos"
                    icon="fas fa-clipboard-list"
                    :headers="['#', 'Producto', 'Categoría', 'Precio', 'Stock', 'Estado', 'Acciones']"
                    :striped="true"
                    :hover="true">
                    
                    <x-slot name="actions">
                        <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-filter mr-2 text-gray-500"></i>
                            Filtrar
                        </button>
                        <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-download mr-2 text-gray-500"></i>
                            Exportar
                        </button>
                    </x-slot>

                    @foreach($products as $product)
                        @php
                            $category = optional($product->taxons->firstWhere('taxonomy_id', 1))->name ?? '-';
                            $state = $product->state->value();
                            $stateConfig = [
                                'active' => ['type' => 'success', 'icon' => 'fas fa-check-circle', 'label' => 'Activo'],
                                'draft' => ['type' => 'warning', 'icon' => 'fas fa-clock', 'label' => 'Pendiente'],
                                'inactive' => ['type' => 'danger', 'icon' => 'fas fa-times-circle', 'label' => 'Inactivo'],
                                'unavailable' => ['type' => 'warning', 'icon' => 'fas fa-exclamation-triangle', 'label' => 'No disponible'],
                                'retired' => ['type' => 'secondary', 'icon' => 'fas fa-archive', 'label' => 'Retirado'],
                            ];
                            $current = $stateConfig[$state] ?? ['type' => 'secondary', 'icon' => 'fas fa-tag', 'label' => ucfirst($state)];
                            
                            $firstImage = $product->getFirstMedia('default');
                            $stockColor = $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-amber-600' : 'text-red-600');
                        @endphp
                        
                        {{-- Usando el componente row --}}
                        <x-admin.ui.table.row :hover="true" :clickable="false">
                            {{-- ID - Usando componente cell --}}
                            <x-admin.ui.table.cell align="left">
                                <span class="text-sm font-bold text-gray-900">
                                    #{{ $product->id }}
                                </span>
                            </x-admin.ui.table.cell>
                            
                            {{-- Producto (con imagen y nombre) --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-3">
                                    @if($firstImage)
                                        <img src="/storage/{{ $firstImage->id }}/{{ $firstImage->file_name }}" 
                                             alt="{{ $product->name }}"
                                             class="w-12 h-12 rounded-lg object-cover border-2 border-gray-200 group-hover:border-blue-400 transition-colors">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-blue-600 transition-colors">
                                            {{ $product->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 font-mono">
                                            <i class="fas fa-barcode mr-1"></i>
                                            {{ $product->sku }}
                                        </p>
                                    </div>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Categoría --}}
                            <x-admin.ui.table.cell>
                                @if($category !== '-')
                                    <x-admin.ui.badge type="info" icon="fas fa-folder" size="sm">
                                        {{ $category }}
                                    </x-admin.ui.badge>
                                @else
                                    <span class="text-sm text-gray-400 italic">Sin categoría</span>
                                @endif
                            </x-admin.ui.table.cell>
                            
                            {{-- Precio --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-dollar-sign text-green-600 text-xs"></i>
                                    <span class="text-sm font-bold text-gray-900">
                                        {{ number_format($product->price, 2) }}
                                    </span>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Stock --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-cubes {{ $stockColor }} text-sm"></i>
                                    <span class="text-sm font-semibold {{ $stockColor }}">
                                        {{ number_format($product->stock, 0) }}
                                    </span>
                                    @if($product->stock == 0)
                                        <x-admin.ui.badge type="danger" size="xs" icon="fas fa-exclamation" :dot="true">
                                            Agotado
                                        </x-admin.ui.badge>
                                    @elseif($product->stock <= 5)
                                        <x-admin.ui.badge type="warning" size="xs" icon="fas fa-exclamation-triangle" :dot="true">
                                            Bajo
                                        </x-admin.ui.badge>
                                    @endif
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Estado - Usando componente badge mejorado --}}
                            <x-admin.ui.table.cell>
                                <x-admin.ui.badge 
                                    :type="$current['type']" 
                                    :icon="$current['icon']"
                                    size="sm">
                                    {{ $current['label'] }}
                                </x-admin.ui.badge>
                            </x-admin.ui.table.cell>
                            
                            {{-- Acciones --}}
                            <x-admin.ui.table.cell align="right">
                                <div class="inline-flex items-center gap-1">
                                    {{-- Ver --}}
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 group/btn"
                                       title="Ver detalles">
                                        <i class="fas fa-eye group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200 group/btn"
                                       title="Editar">
                                        <i class="fas fa-edit group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- Eliminar --}}
                                    <form method="POST" 
                                          action="{{ route('admin.products.destroy', $product) }}" 
                                          class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar {{ $product->name }}?\n\nEsta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 group/btn"
                                                title="Eliminar">
                                            <i class="fas fa-trash group-hover/btn:scale-110 transition-transform"></i>
                                        </button>
                                    </form>
                                </div>
                            </x-admin.ui.table.cell>
                        </x-admin.ui.table.row>
                    @endforeach
                    
                    {{-- Slot de paginación --}}
                    <x-slot name="pagination">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 font-montserrat">
                                Mostrando <span class="font-semibold">{{ $products->firstItem() }}</span> 
                                a <span class="font-semibold">{{ $products->lastItem() }}</span> 
                                de <span class="font-semibold">{{ $products->total() }}</span> productos
                            </div>
                            {{ $products->links() }}
                        </div>
                    </x-slot>
                </x-admin.ui.table>
            @else
                {{-- Estado vacío mejorado --}}
                <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-12">
                    <div class="max-w-md mx-auto text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-box-open text-gray-400 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No hay productos</h3>
                        <p class="text-gray-600 mb-6">
                            Comienza agregando tu primer producto al catálogo para empezar a gestionar tu inventario.
                        </p>
                        <a href="{{ route('admin.products.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Crear Primer Producto
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>