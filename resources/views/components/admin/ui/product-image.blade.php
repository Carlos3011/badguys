@props([
    'media' => null,
    'product' => null,
    'class' => 'w-full h-32 object-cover rounded-lg border-2 border-gray-200',
    'clickable' => false,
    'showName' => true,
])

@php
    $imageUrl = null;
    $imageName = 'Sin imagen';
    
    if ($media) {
        $imageUrl = '/storage/' . $media->id . '/' . $media->file_name;
        $imageName = $media->file_name;
    } elseif ($product) {
        $firstMedia = $product->getFirstMedia('default');
        if ($firstMedia) {
            $imageUrl = '/storage/' . $firstMedia->id . '/' . $firstMedia->file_name;
            $imageName = $firstMedia->file_name;
        }
    }
@endphp

@if($imageUrl)
    <div class="relative group w-full h-full">
        <img 
            src="{{ $imageUrl }}" 
            alt="{{ $imageName }}"
            class="{{ $class }} {{ $clickable ? 'hover:border-gray-300 transition-colors cursor-pointer' : '' }}"
            style="object-fit: cover; object-position: center; width: 100%; height: 100%;"
            @if($clickable) onclick="window.open('{{ $imageUrl }}', '_blank')" @endif
            {{ $attributes }}
            loading="lazy">
        
        @if($showName)
            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 rounded-b-lg">
                <p class="truncate">{{ $imageName }}</p>
            </div>
        @endif
        
        @if($clickable)
            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                    Click para ampliar
                </span>
            </div>
        @endif
    </div>
@else
    <div class="{{ $class }} bg-gray-200 flex items-center justify-center w-full h-full">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
    </div>
@endif