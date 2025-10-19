@props([
    'header' => false,
    'align' => 'left', // left | center | right
    'compact' => false,
])

@php
    $tag = $header ? 'th' : 'td';
    $alignments = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];
    $alignClass = $alignments[$align] ?? $alignments['left'];
    $paddingClass = $compact ? 'px-4 py-2' : 'px-6 py-4';
    $classes = "$paddingClass $alignClass text-sm font-montserrat text-gray-900";
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $tag }}>