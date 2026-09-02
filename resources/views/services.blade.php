@extends('layouts.app')

@section('title', 'Nos services — GRIDD Consulting et Services')

@section('content')
<section class="services-hero">
    <div class="container-content services-hero-grid">
        <div class="max-w-3xl reveal">
            <p class="eyebrow mb-4">Nos services</p>
            <h1 class="services-hero-title">Une expertise structurée pour des décisions qui tiennent dans le temps.</h1>
            <p class="services-hero-lead">De l’étude à l’accompagnement opérationnel, GRIDD mobilise des compétences complémentaires pour sécuriser vos projets et renforcer leur impact.</p>
        </div>
        <div class="services-hero-note reveal reveal-delay-2">
            <span class="services-hero-note-number">02</span>
            <p>pôles d’expertise</p>
            <span class="services-hero-note-line"></span>
            <p class="text-paper/60">Une même exigence de rigueur scientifique, de proximité et de responsabilité.</p>
        </div>
    </div>
</section>

<section class="services-overview section-block">
    <div class="container-content">
        <div class="section-header-row mb-12 reveal">
            <div class="max-w-2xl">
                <p class="eyebrow mb-3">Notre méthode</p>
                <h2 class="section-title">Deux portes d’entrée, un accompagnement sur mesure.</h2>
            </div>
            <p class="max-w-sm text-sm leading-7 text-ink/60">Nos pôles s’articulent selon la réalité de chaque mission : comprendre les enjeux, mesurer les risques et transformer les exigences en solutions concrètes.</p>
        </div>

        <div class="services-index-grid">
            @foreach ($poles as $index => $pole)
                <a href="#pole-{{ $index + 1 }}" class="services-index-card reveal {{ $pole['theme'] === 'green' ? 'services-index-card-green' : 'services-index-card-clay' }}">
                    <div class="flex items-start justify-between gap-4">
                        <span class="services-index-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="services-index-arrow" aria-hidden="true">↘</span>
                    </div>
                    <div>
                        <h3>{{ $pole['pole'] }}</h3>
                        <p>{{ count($pole['items']) }} domaines d’intervention</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="services-details section-block section-alt">
    <div class="container-content">
        <div class="services-details-grid">
            <aside class="services-sticky-intro reveal">
                <p class="eyebrow mb-3">Domaines d’intervention</p>
                <h2 class="section-title">L’expertise au service du terrain.</h2>
                <p class="mt-5 text-sm leading-7 text-ink/60">Chaque intervention est pensée pour produire des résultats lisibles, actionnables et adaptés aux réalités locales.</p>
                <div class="services-side-rule"></div>
                <a href="{{ route('contact') }}" class="btn-outline">Parler de votre projet <span aria-hidden="true">↗</span></a>
            </aside>

            <div class="space-y-8">
                @foreach ($poles as $index => $pole)
                    <article id="pole-{{ $index + 1 }}" class="service-detail-card reveal {{ $pole['theme'] === 'green' ? 'service-detail-card-green' : 'service-detail-card-clay' }}">
                        <div class="service-detail-heading">
                            <span class="service-detail-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <p class="mb-2 text-xs font-bold uppercase tracking-[0.18em] text-paper/55">Pôle d’expertise</p>
                                <h2>{{ $pole['pole'] }}</h2>
                            </div>
                        </div>
                        <div class="service-detail-content">
                            <p class="service-detail-intro">Une approche intégrée pour éclairer les décisions, anticiper les risques et accompagner la mise en œuvre.</p>
                            <ul class="service-detail-list">
                                @foreach ($pole['items'] as $item)
                                    <li><span aria-hidden="true">＋</span>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="services-means section-block">
    <div class="container-content">
        <div class="services-means-card reveal">
            <div class="services-means-mark" aria-hidden="true">GR</div>
            <div class="max-w-2xl">
                <p class="eyebrow mb-3">Nos moyens</p>
                <h2 class="section-title mb-5">Des outils adaptés aux exigences du terrain.</h2>
                <p class="leading-8 text-ink/65">GRIDD Consulting et Services dispose d’un parc automobile et informatique étoffé, ainsi que d’un matériel technique de pointe : station totale, théodolite, GPS, analyseurs de gaz de combustion, sonomètre, luxmètre, détecteurs de poussière et de gaz.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn-primary">Échanger avec un expert <span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>
@endsection
