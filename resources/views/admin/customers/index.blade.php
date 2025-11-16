<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="font-roboto-flex text-2xl font-bold text-gray-900">{{ __('Gestión de Clientes') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 flex items-center gap-2">
                        <i class="fas fa-user-friends text-gray-400"></i>
                        {{ $customers->total() }} clientes registrados
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.customers.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-user-plus mr-2 text-lg"></i>
                Nuevo Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($customers->count())
                <x-admin.ui.table 
                    title="Lista de Clientes"
                    description="Administra la información de tus clientes registrados"
                    icon="fas fa-users"
                    :headers="['#', 'Cliente', 'Email', 'Estado', 'Verificación', 'Registro', 'Acciones']"
                    :striped="true"
                    :hover="true">
                    
                    <x-slot name="actions">
                        {{-- Filtros de búsqueda --}}
                        <form method="GET" class="flex items-center gap-3">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Buscar cliente..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            
                            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todos los estados</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activos</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivos</option>
                            </select>
                            
                            <select name="verified" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Verificación</option>
                                <option value="verified" {{ request('verified') === 'verified' ? 'selected' : '' }}>Verificados</option>
                                <option value="unverified" {{ request('verified') === 'unverified' ? 'selected' : '' }}>Sin verificar</option>
                            </select>
                            
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-filter mr-2"></i>
                                Filtrar
                            </button>
                            
                            @if(request()->hasAny(['search', 'status', 'verified']))
                                <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors">
                                    <i class="fas fa-times mr-2"></i>
                                    Limpiar
                                </a>
                            @endif
                        </form>
                    </x-slot>

                    @foreach($customers as $customer)
                        <x-admin.ui.table.row :hover="true">
                            {{-- ID --}}
                            <x-admin.ui.table.cell align="left">
                                <span class="text-sm font-bold text-gray-900">
                                    #{{ $customer->id }}
                                </span>
                            </x-admin.ui.table.cell>
                            
                            {{-- Información del cliente --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $customer->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            ID: {{ $customer->id }}
                                        </p>
                                    </div>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Email --}}
                            <x-admin.ui.table.cell>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-gray-700">{{ $customer->email }}</span>
                                    <button 
                                        onclick="navigator.clipboard.writeText('{{ $customer->email }}')"
                                        class="text-gray-400 hover:text-blue-600 transition-colors"
                                        title="Copiar email">
                                        <i class="fas fa-copy text-xs"></i>
                                    </button>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Estado --}}
                            <x-admin.ui.table.cell>
                                @if($customer->is_active ?? true)
                                    <x-admin.ui.badge 
                                        type="success" 
                                        icon="fas fa-check-circle"
                                        :dot="true"
                                        size="sm">
                                        Activo
                                    </x-admin.ui.badge>
                                @else
                                    <x-admin.ui.badge 
                                        type="danger" 
                                        icon="fas fa-times-circle"
                                        :dot="true"
                                        size="sm">
                                        Inactivo
                                    </x-admin.ui.badge>
                                @endif
                            </x-admin.ui.table.cell>
                            
                            {{-- Verificación de email --}}
                            <x-admin.ui.table.cell>
                                @if($customer->email_verified_at)
                                    <x-admin.ui.badge 
                                        type="success" 
                                        icon="fas fa-shield-check"
                                        size="sm">
                                        Verificado
                                    </x-admin.ui.badge>
                                @else
                                    <x-admin.ui.badge 
                                        type="warning" 
                                        icon="fas fa-shield-exclamation"
                                        size="sm">
                                        Sin verificar
                                    </x-admin.ui.badge>
                                @endif
                            </x-admin.ui.table.cell>
                            
                            {{-- Fecha de registro --}}
                            <x-admin.ui.table.cell>
                                <div class="text-sm text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-calendar text-gray-400 text-xs"></i>
                                        {{ $customer->created_at->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $customer->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </x-admin.ui.table.cell>
                            
                            {{-- Acciones --}}
                            <x-admin.ui.table.cell align="right">
                                <div class="inline-flex items-center gap-1">
                                    {{-- Ver detalles --}}
                                    <a href="{{ route('admin.customers.show', $customer) }}" 
                                       class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200 group/btn"
                                       title="Ver detalles">
                                        <i class="fas fa-eye group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- Editar --}}
                                    <a href="{{ route('admin.customers.edit', $customer) }}" 
                                       class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all duration-200 group/btn"
                                       title="Editar cliente">
                                        <i class="fas fa-edit group-hover/btn:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- Activar/Desactivar --}}
                                    @if($customer->is_active ?? true)
                                        <form method="POST" action="{{ route('admin.customers.deactivate', $customer) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button 
                                                type="submit" 
                                                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-all duration-200 group/btn"
                                                title="Desactivar cliente"
                                                onclick="return confirm('¿Desactivar cliente {{ $customer->name }}?')">
                                                <i class="fas fa-user-slash group-hover/btn:scale-110 transition-transform"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.customers.activate', $customer) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button 
                                                type="submit" 
                                                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200 group/btn"
                                                title="Activar cliente">
                                                <i class="fas fa-user-check group-hover/btn:scale-110 transition-transform"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    {{-- Verificar/Desverificar email --}}
                                    @if($customer->email_verified_at)
                                        <form method="POST" action="{{ route('admin.customers.unverify-email', $customer) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button 
                                                type="submit" 
                                                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all duration-200 group/btn"
                                                title="Remover verificación"
                                                onclick="return confirm('¿Remover verificación de email?')">
                                                <i class="fas fa-shield-slash group-hover/btn:scale-110 transition-transform"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.customers.verify-email', $customer) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button 
                                                type="submit" 
                                                class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all duration-200 group/btn"
                                                title="Verificar email">
                                                <i class="fas fa-shield-check group-hover/btn:scale-110 transition-transform"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    {{-- Eliminar --}}
                                    <form method="POST" 
                                          action="{{ route('admin.customers.destroy', $customer) }}" 
                                          class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar el cliente {{ $customer->name }}?\n\nEsta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center justify-center w-9 h-9 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 group/btn"
                                            title="Eliminar cliente">
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
                                Mostrando <span class="font-semibold">{{ $customers->firstItem() }}</span> 
                                a <span class="font-semibold">{{ $customers->lastItem() }}</span> 
                                de <span class="font-semibold">{{ $customers->total() }}</span> clientes
                            </div>
                            {{ $customers->appends(request()->query())->links() }}
                        </div>
                    </x-slot>
                </x-admin.ui.table>

                {{-- Estadísticas rápidas --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-blue-600 mb-1">Total Clientes</p>
                                <p class="text-3xl font-bold text-blue-900">{{ $customers->total() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-600 mb-1">Clientes Activos</p>
                                <p class="text-3xl font-bold text-green-900">
                                    {{ $customers->where('is_active', true)->count() }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-check text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-purple-600 mb-1">Emails Verificados</p>
                                <p class="text-3xl font-bold text-purple-900">
                                    {{ $customers->whereNotNull('email_verified_at')->count() }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-purple-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-check text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Nuevos (30 días)</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ $customers->where('created_at', '>=', now()->subDays(30))->count() }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-plus text-gray-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Estado vacío --}}
                <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-12">
                    <div class="max-w-md mx-auto text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-users text-blue-500 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No hay clientes registrados</h3>
                        <p class="text-gray-600 mb-6">
                            Comienza agregando clientes a tu plataforma para gestionar tu base de usuarios.
                        </p>
                        <a href="{{ route('admin.customers.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-user-plus mr-2"></i>
                            Agregar Primer Cliente
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>