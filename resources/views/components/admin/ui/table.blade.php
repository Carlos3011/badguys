@props([
    'title' => null,
    'description' => null,
    'striped' => true,
    'bordered' => true,
    'hover' => true,
    'headers' => null,
    'empty' => __('No hay registros disponibles'),
])

<div class="bg-white {{ $bordered ? 'border border-gray-200' : '' }} rounded-xl shadow-sm">
    <!-- Header -->
    <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
        <div>
            @if($title)
                <h3 class="text-lg font-roboto-flex font-semibold text-gray-900">{{ $title }}</h3>
            @endif
            @if($description)
                <p class="text-sm text-gray-500 font-montserrat">{{ $description }}</p>
            @endif
        </div>
        <div class="flex items-center gap-2">
            {{ $actions ?? '' }}
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-black text-white">
                @if(is_array($headers) && count($headers))
                    <tr>
                        @foreach($headers as $header)
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">{{ $header }}</th>
                        @endforeach
                    </tr>
                @else
                    {{ $columns ?? '' }}
                @endif
            </thead>
            @php
                $tbodyClasses = 'bg-white';
                if ($striped) {
                    $tbodyClasses .= ' [&>tr:nth-child(even)]:bg-gray-50';
                }
                if ($hover) {
                    $tbodyClasses .= ' [&>tr]:transition-colors [&>tr:hover]:bg-gray-100';
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
                        <td class="px-6 py-8 text-center text-gray-500 font-montserrat" colspan="100">{{ $empty }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Footer / Pagination -->
    @if(isset($footer) || isset($pagination))
    <div class="border-t border-gray-200 px-4 py-3">
        {{ $footer ?? ($pagination ?? '') }}
    </div>
    @endif
</div>