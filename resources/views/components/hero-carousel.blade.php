@if ($slides->isNotEmpty())
<section class="hero-carousel" data-carousel aria-label="Bannière principale">
    <div class="hero-orb hero-orb-one"></div>
    <div class="hero-orb hero-orb-two"></div>

    <div class="hero-carousel-track">
        @foreach ($slides as $index => $slide)
            <article class="hero-slide {{ $index === 0 ? 'is-active' : '' }}" data-slide="{{ $index }}">
                <div class="hero-slide-bg">
                    <x-responsive-image :src="$slide->image" :alt="$slide->title" class="w-full h-full object-cover" />
                </div>

                <div class="hero-slide-overlay" aria-hidden="true"></div>

                <div class="hero-slide-content container-content">
                    <div class="hero-slide-text">
                        <div class="hero-chip">
                            <span></span>
                            Bénin & Afrique de l’Ouest
                        </div>

                        @if ($slide->eyebrow)
                            <p class="hero-eyebrow">{{ $slide->eyebrow }}</p>
                        @endif

                        <h1 class="hero-slide-title">{{ $slide->title }}</h1>

                        @if ($slide->subtitle)
                            <p class="hero-slide-subtitle">{{ $slide->subtitle }}</p>
                        @endif

                        <div class="hero-actions">
                            @if ($slide->button_text && $slide->button_url)
                                <a href="{{ $slide->button_url }}" class="btn-hero">{{ $slide->button_text }}</a>
                            @endif

                            <a href="{{ route('projects.index') }}" class="btn-hero-secondary">
                                Voir nos réalisations
                            </a>
                        </div>
                    </div>

                    <div class="hero-floating-card" aria-hidden="true">
                        <p class="hero-floating-label">Impact mesurable</p>
                        <div class="hero-floating-grid">
                            <div>
                                <strong>40+</strong>
                                <span>projets</span>
                            </div>
                            <div>
                                <strong>05</strong>
                                <span>pays</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    @if ($slides->count() > 1)
        <div class="hero-carousel-controls container-content">
            <button type="button" class="hero-nav hero-nav-prev" data-carousel-prev aria-label="Slide précédente">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>

            <div class="hero-dots" role="tablist">
                @foreach ($slides as $index => $slide)
                    <button type="button"
                            class="hero-dot {{ $index === 0 ? 'is-active' : '' }}"
                            data-carousel-dot="{{ $index }}"
                            aria-label="Aller à la slide {{ $index + 1 }}"
                            {{ $index === 0 ? 'aria-selected=true' : '' }}>
                    </button>
                @endforeach
            </div>

            <button type="button" class="hero-nav hero-nav-next" data-carousel-next aria-label="Slide suivante">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </button>
        </div>
    @endif
</section>
@else
<section class="hero-carousel hero-carousel-fallback">
    <div class="hero-orb hero-orb-one"></div>
    <div class="hero-orb hero-orb-two"></div>

    <div class="hero-slide is-active">
        <div class="hero-slide-overlay"></div>

        <div class="hero-slide-content container-content">
            <div class="hero-slide-text">
                <div class="hero-chip">
                    <span></span>
                    Bureau d’études — Bénin & Afrique de l’Ouest
                </div>

                <h1 class="hero-slide-title">Nous mesurons le terrain pour construire l’avenir durable.</h1>
                <p class="hero-slide-subtitle">
                    GRIDD Consulting et Services accompagne institutions, entreprises et collectivités dans la conception,
                    l’évaluation et la mise en œuvre de projets à fort impact.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('services') }}" class="btn-hero">Découvrir nos services</a>
                    <a href="{{ route('contact') }}" class="btn-hero-secondary">Parler d’un projet</a>
                </div>
            </div>

            <div class="hero-floating-card" aria-hidden="true">
                <p class="hero-floating-label">Expertise terrain</p>
                <div class="hero-floating-grid">
                    <div>
                        <strong>40+</strong>
                        <span>projets</span>
                    </div>
                    <div>
                        <strong>20+</strong>
                        <span>experts</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif