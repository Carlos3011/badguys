<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-th-large text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="font-roboto-flex text-2xl font-bold text-gray-900">{{ __('Gestión de Categorías') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 flex items-center gap-2">
                        <i class="fas fa-folder text-gray-400"></i>
                        {{ $taxons->total() }} categorías en total
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-plus-circle mr-2 text-lg"></i>
                Nueva Categoría
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($taxons->count())
                <x-admin.ui.table 
                    title="Lista de Categorías"
                    description="Organiza tus productos por categorías"
                    icon="fas fa-sitemap"
                    :headers="['#', 'Categoría', 'Identificador', 'Productos', 'Estado', 'Acciones']"
                    :striped="true"
                    :hover="true">
                    
                    <x-slot name="actions">
                        <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-search mr-2 text-gray-500"></i>
                            Buscar
                        </button>
                        <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                            <i class="fas fa-sort-alpha-down mr-2 text-gray-500"></i>
                            Ordenar
                        </button>
                    </x-slot>

                    @foreach($taxons as $taxon)
                        @php
                            // Usar el conteo de productos calculado en el controlador
                            $productsCount = $taxon->products_count ?? 0;
                            $isActive = $productsCount > 0;
                        @endphp
                        
                        <x-admin.ui.table.row :hover="true">
                            {{-- ID --}}
                            <x-admin.ui.table.cell align="left">
                                <span class="text-sm font-bold text-gray-900">
                                    #{{ $taxon->id }}
                                </span>
                            </x-admin.ui.table.cell>
                            
                            {{-- Nombre de la categoría con icono --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-folder text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $taxon->name }}
                                        </p>
                                        @if($taxon->parent_id)
                                            <p class="text-xs text-gray-500 flex items-center gap-1">
                                                <i class="fas fa-level-up-alt fa-rotate-90"></i>
                                                Subcategoría
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Slug con formato código --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-mono bg-gray-100 text-gray-700 border border-gray-300">
                                        <i class="fas fa-link text-gray-500 text-[10px]"></i>
                                        {{ $taxon->slug }}
                                    </span>
                                    <button 
                                        onclick="navigator.clipboard.writeText('{{ $taxon->slug }}')"
                                        class="text-gray-400 hover:text-indigo-600 transition-colors"
                                        title="Copiar slug">
                                        <i class="fas fa-copy text-xs"></i>
                                    </button>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Contador de productos --}}
                            <x-admin.ui.table.cell align="center">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <i class="fas fa-box text-gray-400 text-sm"></i>
                                        <span class="text-sm font-semibold {{ $productsCount > 0 ? 'text-indigo-600' : 'text-gray-400' }}">
                                            {{ $productsCount }}
                                        </span>
                                    </div>
                                    @if($productsCount > 0)
                                        <x-admin.ui.badge type="primary" size="xs" icon="fas fa-check">
                                            En uso
                                        </x-admin.ui.badge>
                                    @endif
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Estado --}}
                            <x-admin.ui.table.cell>
                                @if($isActive)
                                    <x-admin.ui.badge 
                                        type="success" 
                                        icon="fas fa-check-circle"
                                        :dot="true"
                                        size="sm">
                                        Activa
                                    </x-admin.ui.badge>
                                @else
                                    <x-admin.ui.badge 
                                        type="secondary" 
                                        icon="fas fa-minus-circle"
                                        size="sm">
                                        Sin productos
                                    </x-admin.ui.badge>
                                @endif
                            </x-admin.ui.table.cell>
                            
                            {{-- Acciones --}}
                            <x-admin.ui.table.cell align="right">
                                <div class="inline-flex items-center gap-1">
                                    {{-- Ver productos de esta categoría --}}
                                    @if($productsCount > 0)
                                        <a href="{{ route('admin.products.index', ['category' => $taxon->id]) }}" 
                                           class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 group/btn"
                                           title="Ver productos ({{ $productsCount }})">
                                            <i class="fas fa-eye group-hover/btn:scale-110 transition-transform"></i>
                                        </a>
                                    @endif
                                    
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.categories.edit', $taxon) }}" 
                                       class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 group/btn"
                                       title="Editar categoría">
                                        <i class="fas fa-edit group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- Eliminar --}}
                                    <form method="POST" 
                                          action="{{ route('admin.categories.destroy', $taxon) }}" 
                                          class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar la categoría {{ $taxon->name }}?{{ $productsCount > 0 ? '\n\n⚠️ Atención: Esta categoría tiene ' . $productsCount . ' producto(s) asociado(s).' : '' }}\n\nEsta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 group/btn {{ $productsCount > 0 ? 'opacity-50' : '' }}"
                                            title="{{ $productsCount > 0 ? 'Categoría con productos asociados' : 'Eliminar categoría' }}"
                                            {{ $productsCount > 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-trash group-hover/btn:scale-110 transition-transform"></i>
                                        </button>
                                    </form>
                                </div>
                            </x-admin.ui.table.cell>
                        </x-admin.ui.table.row>
                    @endforeach
                    
                    {{-- Paginación --}}
                    <x-slot name="pagination">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700 font-montserrat">
                                Mostrando <span class="font-semibold">{{ $taxons->firstItem() }}</span> 
                                a <span class="font-semibold">{{ $taxons->lastItem() }}</span> 
                                de <span class="font-semibold">{{ $taxons->total() }}</span> categorías
                            </div>
                            {{ $taxons->links() }}
                        </div>
                    </x-slot>
                </x-admin.ui.table>

                {{-- Estadísticas rápidas --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 border border-indigo-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-indigo-600 mb-1">Total Categorías</p>
                                <p class="text-3xl font-bold text-indigo-900">{{ $taxons->total() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-th-large text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-600 mb-1">Categorías Activas</p>
                                <p class="text-3xl font-bold text-green-900">
                                    {{ $taxons->filter(fn($t) => ($t->products_count ?? 0) > 0)->count() }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Sin Productos</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ $taxons->filter(fn($t) => ($t->products_count ?? 0) === 0)->count() }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-folder-open text-gray-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Estado vacío --}}
                <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-12">
                    <div class="max-w-md mx-auto text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-th-large text-indigo-500 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No hay categorías</h3>
                        <p class="text-gray-600 mb-6">
                            Comienza creando categorías para organizar tu catálogo de productos de manera eficiente.
                        </p>
                        <a href="{{ route('admin.categories.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Crear Primera Categoría
                        </a>
                        
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-3">
                                <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                                Sugerencias de categorías:
                            </p>
                            <div class="flex flex-wrap gap-2 justify-center">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">Ropa</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">Calzado</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">Accesorios</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">Deportes</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>