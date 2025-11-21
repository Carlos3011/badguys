@props(['src' => null, 'poster' => null, 'title' => null, 'provider' => 'file'])

@php
    $baseSrc = $src;
    $autoSrc = $src;
    if ($provider === 'youtube' && $src) {
        $autoSrc = $src . (str_contains($src, '?') ? '&' : '?') . 'autoplay=1&rel=0';
    }
@endphp

<div x-data="{ open: false, base: '{{ $baseSrc }}', auto: '{{ $autoSrc }}' }">
    <div class="relative rounded-2xl overflow-hidden aspect-video bg-gray-100 ring-1 ring-black/10 shadow">
        @if($poster)
            <img src="{{ $poster }}" alt="{{ $title ?? 'Video' }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center text-black">{{ $title ?? 'Video' }}</div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
        <button type="button" @click="open = true" class="absolute inset-0 flex items-center justify-center">
            <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-white/90 text-black ring-1 ring-black/10 shadow transition-transform duration-200 hover:scale-105">
                <i class="fas fa-play"></i>
            </span>
        </button>
    </div>

    <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 relative">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="open = false"></div>
        <button type="button" @click="open = false" class="absolute top-6 right-6 text-white bg-black/50 rounded-full p-3">
            <i class="fas fa-times text-2xl"></i>
        </button>
        <div class="relative z-10 min-h-screen w-full flex items-center justify-center p-4">
            @if($provider === 'youtube' && $src)
                <iframe x-ref="frame" class="w-full max-w-5xl aspect-video rounded-2xl shadow-2xl" :src="base" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                <div x-effect="if(open && $refs.frame){ $refs.frame.src = auto } else if($refs.frame) { $refs.frame.src = base }"></div>
            @else
                <video class="w-full max-w-5xl rounded-2xl shadow-2xl" src="{{ $src }}" @ended="open=false" controls autoplay poster="{{ $poster }}"></video>
            @endif
        </div>
    </div>
</div>
