@extends('layouts.app')

@section('title', 'Nos réalisations - GRIDD Consulting et Services')

@section('content')

<section class="page-hero">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Réalisations</p>
        <h1 class="page-title">Des projets qui ancrent nos convictions dans le terrain.</h1>
    </div>
</section>

<section class="section-block">
    <div class="container-content">
        <div class="flex flex-wrap gap-3 mb-12">
            <a href="{{ route('projects.index') }}"
               class="filter-pill {{ !$country ? 'filter-pill-active' : '' }}">
                Tous les pays
            </a>
            @foreach ($countries as $c)
                <a href="{{ route('projects.index', ['pays' => $c]) }}"
                   class="filter-pill {{ $country === $c ? 'filter-pill-active' : '' }}">
                    {{ $c }}
                </a>
            @endforeach
        </div>

        @if ($projects->isEmpty())
            <p class="text-ink/60">Aucune réalisation publiée pour le moment.</p>
        @else
            <div class="cards-grid-3 mb-12">
                @foreach ($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>
            {{ $projects->links() }}
        @endif
    </div>
</section>

@endsection
