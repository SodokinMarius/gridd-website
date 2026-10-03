@extends('layouts.app')

@section('title', "À propos - GRIDD Consulting et Services")

@section('content')

<section class="page-hero" id="historique">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">À propos de nous</p>
        <h1 class="page-title">Une expertise au service du développement durable.</h1>
        <p class="page-lead mt-6">{{ $institutional['historique'] }}</p>
    </div>
</section>

<section class="section-block" id="vision">
    <div class="container-content about-grid-2">
        <div class="info-card">
            <h2 class="info-card-title">Notre vision</h2>
            <p class="info-card-text">{{ $institutional['vision'] }}</p>
        </div>
        <div class="info-card">
            <h2 class="info-card-title">Notre mission</h2>
            <p class="info-card-text">{{ $institutional['mission'] }}</p>
        </div>
    </div>
</section>

<section class="section-block section-alt" id="valeurs">
    <div class="container-content">
        <h2 class="section-title mb-10">Nos valeurs</h2>
        <div class="cards-grid-3">
            @foreach ($institutional['valeurs'] as $valeur)
                <div class="value-card">
                    <h3 class="font-display font-semibold text-lg mb-2 text-primary-600">{{ $valeur['titre'] }}</h3>
                    <p class="text-sm text-ink/70">{{ $valeur['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@php($directeur = $institutional['mot_directeur'])
@php($nomDirecteur = trim(($directeur['civilite'] ?? '').' '.$directeur['prenom'].' '.$directeur['nom']))
<section class="director-section section-block" id="directeur">
    <div class="container-content">
        <div class="director-hero">
            <figure class="director-portrait reveal">
                <x-responsive-image
                    :src="$directeur['photo']"
                    :alt="$nomDirecteur.', '.$directeur['poste']"
                    class="h-full w-full object-cover"
                />
                <figcaption>
                    <span>{{ $nomDirecteur }}</span>
                    {{ $directeur['poste'] }}, GRIDD Consulting &amp; Services
                </figcaption>
            </figure>
            <div class="director-hero-content reveal reveal-delay-1">
                <p class="eyebrow mb-4">Message du Directeur Général</p>
                <h2 class="director-title">{{ $directeur['titre'] }}</h2>
                <blockquote class="director-quote">
                    <span class="director-quote-mark" aria-hidden="true">“</span>
                    <p>{{ $directeur['citation'] }}</p>
                </blockquote>
            </div>
        </div>

        <div class="director-letter">
            <p class="director-intro reveal">{{ $directeur['introduction'] }}</p>

            @foreach ($directeur['chapitres'] as $index => $chapitre)
                <div class="director-chapter reveal">
                    <p class="director-chapter-label">
                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        {{ $chapitre['label'] }}
                    </p>
                    <div class="director-chapter-body">
                        @foreach ($chapitre['paragraphes'] as $paragraphe)
                            <p>{{ $paragraphe }}</p>
                        @endforeach
                        @isset($chapitre['expertises'])
                            <ul class="director-expertises">
                                @foreach ($chapitre['expertises'] as $expertise)
                                    <li>{{ $expertise }}</li>
                                @endforeach
                            </ul>
                        @endisset
                        @isset($chapitre['conclusion'])
                            <p>{{ $chapitre['conclusion'] }}</p>
                        @endisset
                    </div>
                </div>
            @endforeach

            <p class="director-declaration reveal">{{ $directeur['declaration'] }}</p>
        </div>

        <div class="director-commitments reveal">
            <p class="director-commitments-title">Notre engagement est simple</p>
            <ol>
                @foreach ($directeur['engagements'] as $index => $engagement)
                    <li>
                        <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        {{ $engagement }}
                    </li>
                @endforeach
            </ol>
            <div class="director-signature">
                <p>{{ $nomDirecteur }}</p>
                <p>{{ $directeur['poste'] }}, GRIDD Consulting &amp; Services</p>
                @if (! empty($directeur['linkedin']))
                    <a href="{{ $directeur['linkedin'] }}" target="_blank" rel="noopener" class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-primary-300 hover:text-white">LinkedIn <span aria-hidden="true">↗</span></a>
                @endif
            </div>
        </div>
    </div>
</section>

@if ($team->isNotEmpty())
<section class="section-block section-alt" id="equipe">
    <div class="container-content">
        <div class="section-header max-w-2xl mb-12">
            <p class="eyebrow mb-3">Notre équipe</p>
            <h2 class="section-title">Les experts du cabinet.</h2>
            <p class="page-lead mt-4">Une équipe pluridisciplinaire engagée pour la rigueur scientifique et le développement durable.</p>
        </div>
        <div class="cards-grid-4">
            @foreach ($team as $member)
                <x-team-card :member="$member" />
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section-block">
    <div class="container-content max-w-3xl">
        <h2 class="section-title mb-4">Notre approche organisationnelle</h2>
        <p class="info-card-text">{{ $institutional['approche'] }}</p>
    </div>
</section>

@endsection
