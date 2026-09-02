@extends('layouts.app')

@section('title', "À propos — GRIDD Consulting et Services")

@section('content')

<section class="page-hero">
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

<section class="section-block">
    <div class="container-content">
        <p class="eyebrow mb-3">Mot du Directeur</p>
        <div class="director-block">
            <div class="director-photo">
                <x-responsive-image
                    :src="$institutional['mot_directeur']['photo']"
                    :alt="$institutional['mot_directeur']['prenom'].' '.$institutional['mot_directeur']['nom']"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="director-content">
                <blockquote class="director-quote">
                    « {{ $institutional['mot_directeur']['message'] }} »
                </blockquote>
                <div class="mt-6">
                    <p class="font-display font-semibold text-lg">
                        {{ $institutional['mot_directeur']['prenom'] }} {{ $institutional['mot_directeur']['nom'] }}
                    </p>
                    <p class="text-primary-600 text-sm mt-1">{{ $institutional['mot_directeur']['poste'] }}</p>
                </div>
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
