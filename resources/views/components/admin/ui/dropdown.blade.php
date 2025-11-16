@props([
    'align' => 'left', // left | right
    'width' => '48',
])

@php
    $alignmentClasses = [
        'left' => 'origin-top-left left-0',
        'right' => 'origin-top-right right-0',
    ];
    $contentClasses = $alignmentClasses[$align] ?? $alignmentClasses['left'];
    $widthClass = 'w-' . ($width === 'auto' ? 'auto' : $width);
@endphp

<div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Trigger -->
    <div @click="open = !open" class="cursor-pointer">
        {{ $trigger ?? $slot }}
    </div>

    <!-- Menu -->
    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-10 mt-2 {{ $contentClasses }}">
        <div class="{{ $widthClass }} rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1">
                {{ $content ?? '' }}
            </div>
        </div>
    </div>
</div>