@props(['src' => null, 'alt' => '', 'class' => ''])

@php
    $url = \App\Support\Media::url($src);
@endphp

@if ($url)
    <img src="{{ $url }}" alt="{{ $alt }}" {{ $attributes->merge(['class' => $class]) }}>
@else
    <div {{ $attributes->merge(['class' => trim('img-placeholder '.$class)]) }} aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-8 h-8 opacity-40">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
    </div>
@endif
