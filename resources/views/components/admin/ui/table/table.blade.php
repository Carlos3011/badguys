@props([
    'title' => null,
    'description' => null,
    'icon' => 'fas fa-table',
    'striped' => true,
    'bordered' => true,
    'hover' => true,
    'compact' => false,
    'headers' => null,
    'empty' => __('No hay registros disponibles'),
    'emptyIcon' => 'fas fa-inbox',
    'loading' => false,
    'sortable' => false,
])

<div class="bg-white {{ $bordered ? 'border border-gray-200' : '' }} rounded-xl shadow-sm overflow-hidden">
    <!-- Header -->
    @if($title || $description || isset($actions))
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if($icon)
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="{{ $icon }} text-blue-600"></i>
                        </div>
                    @endif
                    <div>
                        @if($title)
                            <h3 class="text-lg font-roboto-flex font-bold text-gray-900">{{ $title }}</h3>
                        @endif
                        @if($description)
                            <p class="text-sm text-gray-600 font-montserrat mt-0.5">{{ $description }}</p>
                        @endif
                    </div>
                </div>
                @if(isset($actions))
                    <div class="flex items-center gap-2">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Loading State -->
    @if($loading)
        <div class="px-6 py-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <i class="fas fa-spinner fa-spin text-blue-600 text-2xl"></i>
            </div>
            <p class="text-gray-600 font-montserrat">Cargando datos...</p>
        </div>
    @else
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Table Head -->
                <thead class="bg-gradient-to-r from-gray-800 to-gray-900">
                    @if(is_array($headers) && count($headers))
                        <tr>
                            @foreach($headers as $key => $header)
                                <th scope="col" class="px-6 {{ $compact ? 'py-2' : 'py-4' }} text-left text-xs font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        @if($sortable && is_string($key))
                                            <button type="button" class="flex items-center gap-2 hover:text-blue-300 transition-colors group">
                                                <span>{{ $header }}</span>
                                                <i class="fas fa-sort text-gray-400 group-hover:text-blue-300 text-xs"></i>
                                            </button>
                                        @else
                                            {{ $header }}
                                        @endif
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    @else
                        {{ $columns ?? '' }}
                    @endif
                </thead>

                <!-- Table Body -->
                @php
                    $tbodyClasses = 'bg-white divide-y divide-gray-200';
                    if ($striped) {
                        $tbodyClasses .= ' [&>tr:nth-child(even)]:bg-gray-50';
                    }
                    if ($hover) {
                        $tbodyClasses .= ' [&>tr]:transition-all [&>tr]:duration-150 [&>tr:hover]:bg-blue-50 [&>tr:hover]:shadow-sm';
                    }
                @endphp
                <tbody class="{{ $tbodyClasses }}">
                    @php($defaultSlot = trim($slot))
                    @if(isset($rows))
                        {{ $rows }}
                    @elseif(!empty($defaultSlot))
                        {{ $slot }}
                    @else
                        <tr>
                            <td class="px-6 {{ $compact ? 'py-8' : 'py-16' }} text-center" colspan="100">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="{{ $emptyIcon }} text-gray-400 text-3xl"></i>
                                    </div>
                                    <p class="text-gray-600 font-montserrat font-medium mb-1">{{ $empty }}</p>
                                    <p class="text-sm text-gray-500">No se encontraron registros para mostrar</p>
                                    @if(isset($emptyAction))
                                        <div class="mt-4">
                                            {{ $emptyAction }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endif

    <!-- Footer / Pagination -->
    @if(isset($footer) || isset($pagination))
        <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
            {{ $footer ?? ($pagination ?? '') }}
        </div>
    @endif
</div>