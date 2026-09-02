@extends('layouts.app')

@section('title', 'GRIDD Consulting et Services — Bureau d\'études Bénin & Afrique de l\'Ouest')

@section('content')

    <x-hero-carousel :slides="$heroSlides" />

    {{-- STATS --}}
    <section class="stats-bar reveal">
        <div class="container-content stats-grid">
            <div class="reveal reveal-delay-1"><div class="stat-number">2022</div><p class="stat-label">Année de création</p></div>
            <div class="reveal reveal-delay-2"><div class="stat-number">40+</div><p class="stat-label">Projets réalisés</p></div>
            <div class="reveal reveal-delay-3"><div class="stat-number">05</div><p class="stat-label">Pays d'intervention</p></div>
            <div class="reveal reveal-delay-4"><div class="stat-number">20+</div><p class="stat-label">Experts mobilisables</p></div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section class="section-block">
        <div class="container-content">
            <div class="section-header max-w-2xl reveal">
                <p class="eyebrow mb-3">Nos services</p>
                <h2 class="section-title">Deux pôles d'expertise, une même exigence de rigueur.</h2>
            </div>
            <div class="services-grid">
                @foreach (config('services_content') as $pole)
                    <div class="service-card reveal {{ $pole['theme'] === 'green' ? 'service-card-green' : 'service-card-clay' }}">
                        <h3 class="text-xl font-semibold mb-4 text-white">{{ $pole['pole'] }}</h3>
                        <ul class="service-list">
                            @foreach (array_slice($pole['items'], 0, 5) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('services') }}" class="service-link">En savoir plus →</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- REALISATIONS --}}
    @if ($projects->isNotEmpty())
    <section class="section-block section-alt">
        <div class="container-content">
            <div class="section-header-row reveal">
                <div class="max-w-xl">
                    <p class="eyebrow mb-3">Réalisations</p>
                    <h2 class="section-title">Des projets qui ancrent nos convictions dans le terrain.</h2>
                </div>
                <a href="{{ route('projects.index') }}" class="nav-link">Voir tous les projets →</a>
            </div>
            <div class="cards-grid-3">
                @foreach ($projects as $project)
                    <div class="reveal">
                        <x-project-card :project="$project" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- TEMOIGNAGES --}}
    @if ($testimonials->isNotEmpty())
    <section class="section-block">
        <div class="container-content">
            <div class="section-header max-w-2xl mb-12 reveal">
                <p class="eyebrow mb-3">Témoignages</p>
                <h2 class="section-title">La confiance de nos partenaires.</h2>
            </div>
            <div class="cards-grid-3">
                @foreach ($testimonials as $testimonial)
                    <div class="reveal">
                        <x-testimonial-card :testimonial="$testimonial" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- PARTENAIRES --}}
    @if ($partners->isNotEmpty())
    <section class="section-block section-partners">
        <div class="container-content">
            <div class="section-header-row reveal">
                <div class="max-w-2xl">
                    <p class="eyebrow mb-3">Ils nous font confiance</p>
                    <h2 class="section-title">Des collaborations qui donnent de la portée à nos expertises.</h2>
                </div>
                <p class="max-w-sm text-sm leading-7 text-ink/55">GRIDD avance aux côtés d’institutions et d’organisations engagées pour un développement durable.</p>
            </div>
            <div class="partners-grid">
                @foreach ($partners as $partner)
                    @php $partnerUrl = $partner->url ?: null; @endphp
                    @if ($partnerUrl)
                    <a href="{{ $partnerUrl }}" target="_blank" rel="noopener noreferrer" class="partner-card reveal" aria-label="Visiter le site de {{ $partner->name }}">
                    @else
                    <div class="partner-card reveal">
                    @endif
                        <div class="partner-logo">
                            @if ($partner->logo)
                                <x-responsive-image :src="$partner->logo" :alt="$partner->name" class="h-full w-full object-contain" />
                            @else
                                <span>{{ mb_strtoupper(mb_substr($partner->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="flex min-w-0 items-center justify-between gap-3">
                            <p class="truncate font-display text-sm font-semibold text-ink/75">{{ $partner->name }}</p>
                            @if ($partnerUrl)<span class="partner-arrow" aria-hidden="true">↗</span>@endif
                        </div>
                    @if ($partnerUrl)
                    </a>
                    @else
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ACTUALITES --}}
    @if ($news->isNotEmpty())
    <section class="section-block section-alt">
        <div class="container-content">
            <div class="section-header-row reveal">
                <div class="max-w-xl">
                    <p class="eyebrow mb-3">Actualités</p>
                    <h2 class="section-title">La vie de GRIDD, au fil des missions.</h2>
                </div>
                <a href="{{ route('news.index') }}" class="nav-link">Toutes les actualités →</a>
            </div>
            <div class="cards-grid-3">
                @foreach ($news as $article)
                    <article class="news-card reveal">
                        @if ($article->cover_image)
                            <div class="news-card-image">
                                <x-responsive-image :src="$article->cover_image" :alt="$article->title" class="w-full h-full object-cover" />
                            </div>
                        @endif
                        <div class="news-card-body">
                            <p class="text-xs text-clay-600 mb-2 font-medium">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                            <h3 class="font-display font-medium text-lg mb-3 text-ink">{{ $article->title }}</h3>
                            <a href="{{ route('news.show', $article) }}" class="nav-link">Lire l'article →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="cta-band reveal">
        <div class="container-content cta-band-inner">
            <h2 class="text-2xl md:text-3xl font-semibold max-w-lg text-white">Un projet à mener, une expertise à mobiliser ?</h2>
            <a href="{{ route('contact') }}" class="btn-hero">Parlons de votre projet</a>
        </div>
    </section>

@endsection
