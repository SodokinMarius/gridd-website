@props(['partner', 'fallback' => null])

@if ($partner->countryName())
    <span {{ $attributes->merge(['class' => 'partner-country']) }}>
        @if ($partner->flagUrl())
            <img src="{{ $partner->flagUrl() }}" alt="" width="20" height="15" loading="lazy" class="partner-flag">
        @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="partner-flag partner-flag-globe" aria-hidden="true">
                <circle cx="12" cy="12" r="9"/>
                <path d="M3 12h18M12 3c2.5 2.6 3.8 5.6 3.8 9s-1.3 6.4-3.8 9c-2.5-2.6-3.8-5.6-3.8-9S9.5 5.6 12 3Z"/>
            </svg>
        @endif
        {{ $partner->countryName() }}
    </span>
@elseif ($fallback)
    {{ $fallback }}
@endif
