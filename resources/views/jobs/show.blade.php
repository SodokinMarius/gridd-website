@extends('layouts.app')

@section('title', $job->title.' — GRIDD Consulting et Services')

@section('content')

<section class="page-hero">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">{{ $job->contract_type }} @if($job->location) — {{ $job->location }} @endif</p>
        <h1 class="page-title">{{ $job->title }}</h1>
        @if ($job->deadline)
            <p class="text-clay-500 text-sm mt-4">Date limite de candidature : {{ $job->deadline->translatedFormat('d F Y') }}</p>
        @endif
    </div>
</section>

<section class="section-block">
    <div class="container-content max-w-3xl">
        <div class="prose-content">
            {!! nl2br(e($job->description)) !!}
        </div>
    </div>
</section>

<section class="section-block section-alt">
    <div class="container-content max-w-3xl">
        <h2 class="section-title text-xl mb-4">Comment postuler ?</h2>
        <p class="info-card-text mb-6">Utilisez notre formulaire de candidature dédié pour envoyer votre CV et votre lettre de motivation.</p>
        <a href="{{ route('jobs.apply', $job) }}" class="btn-primary">Postuler à cette offre</a>
    </div>
</section>

@endsection
