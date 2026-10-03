@extends('layouts.app')

@section('title', 'Nos services - GRIDD Consulting et Services')

@section('content')
<section class="services-hero">
    <div class="container-content services-hero-grid">
        <div class="max-w-3xl reveal">
            <p class="eyebrow mb-4">Nos services</p>
            <h1 class="services-hero-title">Une expertise intégrée pour des décisions éclairées et des projets durables.</h1>
            <p class="services-hero-lead">De l’étude à l’accompagnement opérationnel, GRIDD mobilise des compétences pluridisciplinaires pour répondre aux enjeux environnementaux, sociaux et techniques de vos projets, maîtriser les risques et accompagner leur mise en œuvre durable.</p>
        </div>
        <div class="services-hero-note reveal reveal-delay-2">
            <span class="services-hero-note-number">{{ str_pad(count($poles), 2, '0', STR_PAD_LEFT) }}</span>
            <p>domaines d’intervention</p>
            <span class="services-hero-note-line"></span>
            <p class="text-paper/60">Une même exigence de rigueur scientifique, de proximité et de responsabilité.</p>
        </div>
    </div>
</section>

<section class="services-overview section-block">
    <div class="container-content">
        <div class="services-method-header reveal">
            <div>
                <p class="eyebrow mb-3">Notre méthode</p>
                <h2 class="section-title">Une approche structurée, participative et orientée vers des solutions durables.</h2>
            </div>
            <p class="services-method-lead">GRIDD privilégie une approche fondée sur l’écoute, l’analyse du terrain et la mobilisation d’expertises complémentaires. Nous combinons rigueur méthodologique, connaissance des réalités locales et concertation avec les parties prenantes afin de produire des solutions adaptées aux enjeux de chaque projet.</p>
        </div>

        <div class="services-method-panel reveal">
            <h3 class="services-method-subtitle">Notre démarche repose sur <span>cinq principes</span></h3>
            <ol class="services-method-steps">
                @foreach ([
                    ['Comprendre', 'Analyser le contexte, les besoins, les enjeux et les réalités du terrain pour disposer d’une compréhension précise de chaque projet.'],
                    ['Anticiper', 'Identifier en amont les risques, contraintes, impacts et opportunités afin de mieux orienter les choix et prévenir les difficultés.'],
                    ['Analyser', 'Mobiliser des compétences pluridisciplinaires et des outils adaptés pour identifier les risques, les contraintes, les opportunités et les impacts potentiels.'],
                    ['Concertation', 'Associer les parties prenantes et valoriser les connaissances locales afin de favoriser des décisions pertinentes, inclusives et partagées.'],
                    ['Accompagner', 'Transformer les analyses en recommandations et en solutions opérationnelles, puis accompagner leur mise en œuvre et leur suivi dans une logique d’amélioration continue.'],
                ] as $index => [$title, $text])
                    <li class="services-method-step">
                        <span class="services-method-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h4>{{ $title }}</h4>
                        <p>{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="services-method-summary reveal">
            <p class="services-method-summary-label">Notre méthode</p>
            <p class="services-method-summary-text">
                <mark>Comprendre le terrain</mark>, <mark>anticiper les enjeux</mark>, <mark>éclairer la décision</mark> et <mark>accompagner l’action</mark> pour construire des projets responsables et durables.
            </p>
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
                        <p>{{ count($pole['items']) }} prestations</p>
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
                <h2 class="section-title">Des expertises pluridisciplinaires au service de projets responsables et durables.</h2>
                <p class="mt-5 text-sm leading-7 text-ink/60">GRIDD Consulting &amp; Services intervient à différentes étapes du cycle de vie des projets, en mobilisant des compétences techniques, environnementales, sociales et opérationnelles adaptées aux enjeux de chaque mission.</p>
                <div class="services-side-rule"></div>
                <a href="{{ route('contact') }}" class="btn-outline">Parler de votre projet <span aria-hidden="true">↗</span></a>
            </aside>

            <div class="space-y-8">
                @foreach ($poles as $index => $pole)
                    <article id="pole-{{ $index + 1 }}" class="service-detail-card reveal {{ $pole['theme'] === 'green' ? 'service-detail-card-green' : 'service-detail-card-clay' }}">
                        <div class="service-detail-heading">
                            <span class="service-detail-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <p class="mb-2 text-xs font-bold uppercase tracking-[0.18em] text-paper/55">Domaine d’intervention</p>
                                <h2>{{ $pole['pole'] }}</h2>
                            </div>
                        </div>
                        <div class="service-detail-content">
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
