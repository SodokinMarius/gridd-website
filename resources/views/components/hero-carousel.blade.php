@if ($slides->isNotEmpty())
<section class="hero-carousel" data-carousel aria-label="Bannière principale">
    <div class="hero-carousel-track">
        @foreach ($slides as $index => $slide)
            <article class="hero-slide {{ $index === 0 ? 'is-active' : '' }}" data-slide="{{ $index }}">
                <div class="hero-slide-bg">
                    <x-responsive-image :src="$slide->image" :alt="$slide->title" class="w-full h-full object-cover" />
                </div>
                <div class="hero-slide-overlay" aria-hidden="true"></div>
                <div class="hero-slide-content container-content">
                    <div class="hero-slide-text">
                        @if ($slide->eyebrow)
                            <p class="hero-eyebrow">{{ $slide->eyebrow }}</p>
                        @endif
                        <h1 class="hero-slide-title">{{ $slide->title }}</h1>
                        @if ($slide->subtitle)
                            <p class="hero-slide-subtitle">{{ $slide->subtitle }}</p>
                        @endif
                        @if ($slide->button_text && $slide->button_url)
                            <a href="{{ $slide->button_url }}" class="btn-hero">{{ $slide->button_text }}</a>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    @if ($slides->count() > 1)
        <div class="hero-carousel-controls container-content">
            <button type="button" class="hero-nav hero-nav-prev" data-carousel-prev aria-label="Slide précédente">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <div class="hero-dots" role="tablist">
                @foreach ($slides as $index => $slide)
                    <button type="button"
                            class="hero-dot {{ $index === 0 ? 'is-active' : '' }}"
                            data-carousel-dot="{{ $index }}"
                            aria-label="Aller à la slide {{ $index + 1 }}"
                            {{ $index === 0 ? 'aria-selected=true' : '' }}></button>
                @endforeach
            </div>
            <button type="button" class="hero-nav hero-nav-next" data-carousel-next aria-label="Slide suivante">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </div>
    @endif
</section>
@else
<section class="hero-carousel hero-carousel-fallback">
    <div class="hero-slide is-active">
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content container-content">
            <div class="hero-slide-text">
                <p class="hero-eyebrow">Bureau d'études — Bénin &amp; Afrique de l'Ouest</p>
                <h1 class="hero-slide-title">Nous mesurons le terrain pour construire l'avenir durable.</h1>
                <p class="hero-slide-subtitle">GRIDD Consulting et Services accompagne institutions, entreprises et collectivités.</p>
                <a href="{{ route('services') }}" class="btn-hero">Découvrir nos services</a>
            </div>
        </div>
    </div>
</section>
@endif
