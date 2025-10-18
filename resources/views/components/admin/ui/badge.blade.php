@props([
    'type' => 'default', // default | primary | success | warning | danger | info | secondary
    'outline' => false,
    'size' => 'md', // xs | sm | md | lg
    'icon' => null, // Font Awesome icon class
    'iconPosition' => 'left', // left | right
    'pulse' => false, // Animación de pulso
    'removable' => false, // Mostrar X para remover
    'dot' => false, // Mostrar punto indicador
])

@php
    $base = 'inline-flex items-center gap-1.5 rounded-full font-montserrat font-medium transition-all duration-200';
    
    $sizes = [
        'xs' => 'text-xs px-2 py-0.5',
        'sm' => 'text-xs px-2.5 py-1',
        'md' => 'text-sm px-3 py-1.5',
        'lg' => 'text-base px-4 py-2',
    ];

    $variants = [
        'default' => [
            'bg' => 'bg-gray-100 hover:bg-gray-200',
            'text' => 'text-gray-800',
            'border' => 'border-gray-300',
            'dot' => 'bg-gray-500',
            'icon' => 'fas fa-circle',
        ],
        'primary' => [
            'bg' => 'bg-blue-100 hover:bg-blue-200',
            'text' => 'text-blue-800',
            'border' => 'border-blue-300',
            'dot' => 'bg-blue-500',
            'icon' => 'fas fa-star',
        ],
        'success' => [
            'bg' => 'bg-green-100 hover:bg-green-200',
            'text' => 'text-green-800',
            'border' => 'border-green-300',
            'dot' => 'bg-green-500',
            'icon' => 'fas fa-check-circle',
        ],
        'warning' => [
            'bg' => 'bg-amber-100 hover:bg-amber-200',
            'text' => 'text-amber-800',
            'border' => 'border-amber-300',
            'dot' => 'bg-amber-500',
            'icon' => 'fas fa-exclamation-triangle',
        ],
        'danger' => [
            'bg' => 'bg-red-100 hover:bg-red-200',
            'text' => 'text-red-800',
            'border' => 'border-red-300',
            'dot' => 'bg-red-500',
            'icon' => 'fas fa-times-circle',
        ],
        'info' => [
            'bg' => 'bg-blue-100 hover:bg-blue-200',
            'text' => 'text-blue-800',
            'border' => 'border-blue-300',
            'dot' => 'bg-blue-500',
            'icon' => 'fas fa-info-circle',
        ],
        'secondary' => [
            'bg' => 'bg-gray-200 hover:bg-gray-300',
            'text' => 'text-gray-900',
            'border' => 'border-gray-400',
            'dot' => 'bg-gray-600',
            'icon' => 'fas fa-tag',
        ],
    ];

    $variant = $variants[$type] ?? $variants['default'];
    
    $outlineClasses = $outline 
        ? "bg-white border {$variant['border']} {$variant['text']} hover:bg-gray-50" 
        : "{$variant['bg']} {$variant['text']}";
    
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $pulseClass = $pulse ? 'animate-pulse' : '';
    
    $classes = trim("$base $sizeClass $outlineClasses $pulseClass");
    
    // Determinar el icono a usar
    $displayIcon = $icon ?? ($dot ? null : $variant['icon']);
    
    // Tamaños de iconos según el tamaño del badge
    $iconSizes = [
        'xs' => 'text-[10px]',
        'sm' => 'text-xs',
        'md' => 'text-sm',
        'lg' => 'text-base',
    ];
    $iconSize = $iconSizes[$size] ?? $iconSizes['md'];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{-- Dot indicator --}}
    @if($dot)
        <span class="relative flex h-2 w-2">
            @if($pulse)
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $variant['dot'] }} opacity-75"></span>
            @endif
            <span class="relative inline-flex rounded-full h-2 w-2 {{ $variant['dot'] }}"></span>
        </span>
    @endif
    
    {{-- Icon left --}}
    @if($displayIcon && $iconPosition === 'left')
        <i class="{{ $displayIcon }} {{ $iconSize }}"></i>
    @endif
    
    {{-- Content --}}
    <span>{{ $slot }}</span>
    
    {{-- Icon right --}}
    @if($displayIcon && $iconPosition === 'right')
        <i class="{{ $displayIcon }} {{ $iconSize }}"></i>
    @endif
    
    {{-- Remove button --}}
    @if($removable)
        <button type="button" class="ml-0.5 -mr-1 hover:bg-black/10 rounded-full p-0.5 transition-colors" onclick="this.closest('span').remove()">
            <i class="fas fa-times {{ $iconSize }}"></i>
        </button>
    @endif
</span>