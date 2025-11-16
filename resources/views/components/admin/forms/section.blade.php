@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'iconColor' => 'blue',
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'orange' => 'bg-orange-100 text-orange-600',
        'red' => 'bg-red-100 text-red-600',
        'indigo' => 'bg-indigo-100 text-indigo-600',
    ];
@endphp

<div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
    @if($title)
        <div class="flex items-start gap-4 p-6 border-b border-gray-100">
            @if($icon)
                <div class="flex-shrink-0 w-12 h-12 {{ $colorClasses[$iconColor] ?? $colorClasses['blue'] }} rounded-xl flex items-center justify-center shadow-sm">
                    <i class="{{ $icon }} text-lg"></i>
                </div>
            @endif
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-bold text-gray-900 font-roboto-flex">{{ $title }}</h3>
                @if($description)
                    <p class="text-sm text-gray-600 font-montserrat mt-1">{{ $description }}</p>
                @endif
            </div>
        </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
</div>