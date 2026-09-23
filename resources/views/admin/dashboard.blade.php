@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
<div class="space-y-8">
    <section class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
        <div>
            <p class="eyebrow mb-3">Vue d’ensemble</p>
            <h2 class="max-w-3xl font-display text-3xl font-bold tracking-[-0.055em] text-ink md:text-5xl">
                Pilotez votre présence digitale avec précision.
            </h2>
            <p class="mt-4 max-w-2xl text-base leading-7 text-ink/60">
                Suivez la santé des contenus de GRIDD, les dernières publications et les éléments à maintenir à jour.
            </p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="btn-outline flex-shrink-0">
            Voir le site public <span aria-hidden="true">↗</span>
        </a>
    </section>

    <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4" aria-label="Indicateurs principaux">
        <article class="admin-stat-card">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-ink/55">Réalisations publiées</p>
                    <strong class="admin-stat-value">{{ $stats['projects_published'] }}</strong>
                    <p class="mt-2 text-xs text-ink/45">{{ $stats['projects'] }} projet(s) au total</p>
                </div>
                <span class="admin-stat-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M4 19.5V8.8L12 4l8 4.8v10.7M4 9l8 4.8L20 9M12 13.8v6.2"/></svg>
                </span>
            </div>
        </article>

        <article class="admin-stat-card">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-ink/55">Actualités visibles</p>
                    <strong class="admin-stat-value">{{ $stats['news_published'] }}</strong>
                    <p class="mt-2 text-xs text-ink/45">{{ $stats['news'] }} article(s) au total</p>
                </div>
                <span class="admin-stat-icon bg-clay-50 text-clay-600" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M5 5.5h14v13H5zM8 9h8M8 12h8M8 15h5"/></svg>
                </span>
            </div>
        </article>

        <article class="admin-stat-card">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-ink/55">Photos en ligne</p>
                    <strong class="admin-stat-value">{{ $stats['gallery'] }}</strong>
                    <p class="mt-2 text-xs text-ink/45">Galerie publique</p>
                </div>
                <span class="admin-stat-icon bg-sky-50 text-sky-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><rect x="4" y="5" width="16" height="14" rx="2"/><circle cx="9" cy="10" r="1.5"/><path d="m5 17 4-4 3 3 2-2 5 4"/></svg>
                </span>
            </div>
        </article>

        <article class="admin-stat-card">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-ink/55">Postes actifs</p>
                    <strong class="admin-stat-value">{{ $stats['jobs_active'] }}</strong>
                    <p class="mt-2 text-xs text-ink/45">Opportunités ouvertes</p>
                </div>
                <span class="admin-stat-icon bg-violet-50 text-violet-700" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><rect x="4" y="7" width="16" height="12" rx="2"/><path d="M9 7V5h6v2M4 12h16M10 12v2h4v-2"/></svg>
                </span>
            </div>
        </article>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1.4fr_1fr]">
        <article class="admin-panel">
            <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-primary-700">Rythme éditorial</p>
                    <h3 class="mt-2 font-display text-xl font-bold tracking-[-0.04em]">Actualités publiées</h3>
                </div>
                <span class="rounded-full bg-stone-100 px-3 py-1.5 text-xs font-bold text-ink/55">6 derniers mois</span>
            </div>

            <div class="admin-chart" aria-label="Graphique des actualités publiées par mois">
                @foreach ($newsTimeline as $month)
                    @php
                        $height = $month['count'] > 0 ? max(10, round(($month['count'] / $newsChartMax) * 100)) : 4;
                    @endphp
                    <div class="flex h-full min-w-0 flex-1 flex-col justify-end">
                        <span class="mb-2 text-center text-xs font-bold text-ink/60">{{ $month['count'] }}</span>
                        <div class="admin-chart-bar" style="height: {{ $height }}%;" title="{{ $month['count'] }} actualité(s) en {{ $month['label'] }}"></div>
                        <span class="admin-chart-label">{{ $month['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </article>

        <article class="admin-panel">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-clay-600">Rayonnement</p>
                    <h3 class="mt-2 font-display text-xl font-bold tracking-[-0.04em]">Projets par pays</h3>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Gérer</a>
            </div>

            <div class="space-y-5">
                @forelse ($projectCountries as $country => $count)
                    @php $width = max(8, round(($count / $countryChartMax) * 100)); @endphp
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-4 text-sm">
                            <span class="truncate font-semibold text-ink/75">{{ $country }}</span>
                            <span class="font-display font-bold text-ink">{{ $count }}</span>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-stone-100">
                            <div class="h-full rounded-full bg-gradient-to-r from-primary-700 to-primary-300 transition-all duration-700" style="width: {{ $width }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-ink/50">Aucun projet publié à analyser.</p>
                @endforelse
            </div>
        </article>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1fr_1.15fr]">
        <article class="admin-panel">
            <div class="mb-3 flex items-center justify-between gap-4">
                <div>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-primary-700">Actions rapides</p>
                    <h3 class="mt-2 font-display text-xl font-bold tracking-[-0.04em]">Mettre à jour le site</h3>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.projects.create') }}" class="admin-quick-action">Ajouter une réalisation <span aria-hidden="true">＋</span></a>
                <a href="{{ route('admin.news.create') }}" class="admin-quick-action">Publier une actualité <span aria-hidden="true">＋</span></a>
                <a href="{{ route('admin.gallery.create') }}" class="admin-quick-action">Ajouter des photos <span aria-hidden="true">＋</span></a>
                <a href="{{ route('admin.hero.create') }}" class="admin-quick-action">Modifier la bannière <span aria-hidden="true">＋</span></a>
            </div>
        </article>

        <article class="admin-panel">
            <div class="mb-3 flex items-center justify-between gap-4">
                <div>
                    <p class="text-[0.68rem] font-bold uppercase tracking-[0.18em] text-clay-600">État éditorial</p>
                    <h3 class="mt-2 font-display text-xl font-bold tracking-[-0.04em]">Santé des contenus</h3>
                </div>
                <span class="rounded-full bg-primary-50 px-3 py-1.5 text-xs font-bold text-primary-700">En direct</span>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ($contentHealth as $health)
                    @php
                        $percentage = $health['total'] > 0 ? min(100, round(($health['value'] / $health['total']) * 100)) : 0;
                        $toneClass = match ($health['tone']) {
                            'clay' => 'text-clay-600 bg-clay-50',
                            'ink' => 'text-ink bg-stone-100',
                            default => 'text-primary-700 bg-primary-50',
                        };
                    @endphp
                    <div class="rounded-2xl bg-stone-50 p-4">
                        <div class="mb-3 flex items-center justify-between gap-3">
                            <span class="text-xs font-semibold leading-5 text-ink/55">{{ $health['label'] }}</span>
                            <span class="rounded-full px-2 py-1 text-xs font-bold {{ $toneClass }}">{{ $percentage }}%</span>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-white">
                            <div class="h-full rounded-full bg-primary-500 transition-all duration-700" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </article>
    </section>

    <section class="grid gap-6 xl:grid-cols-3">
        <article class="admin-panel xl:col-span-1">
            <div class="mb-2 flex items-center justify-between gap-4">
                <h3 class="font-display text-xl font-bold tracking-[-0.04em]">Dernières actualités</h3>
                <a href="{{ route('admin.news.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Tout voir</a>
            </div>
            <div>
                @forelse ($latestNews as $item)
                    <div class="admin-activity-item">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-ink/80">{{ $item->title }}</p>
                            <p class="mt-1 text-xs text-ink/45">{{ $item->created_at?->translatedFormat('d M Y') }}</p>
                        </div>
                        <span class="admin-status {{ $item->is_published ? 'admin-status-published' : 'admin-status-draft' }}">
                            {{ $item->is_published ? 'Publiée' : 'Brouillon' }}
                        </span>
                    </div>
                @empty
                    <p class="py-6 text-sm text-ink/50">Aucune actualité.</p>
                @endforelse
            </div>
        </article>

        <article class="admin-panel xl:col-span-1">
            <div class="mb-2 flex items-center justify-between gap-4">
                <h3 class="font-display text-xl font-bold tracking-[-0.04em]">Dernières réalisations</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Tout voir</a>
            </div>
            <div>
                @forelse ($latestProjects as $item)
                    <div class="admin-activity-item">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-ink/80">{{ $item->title }}</p>
                            <p class="mt-1 text-xs text-ink/45">{{ $item->year }} · {{ $item->country }}</p>
                        </div>
                        <span class="admin-status {{ $item->is_published ? 'admin-status-published' : 'admin-status-draft' }}">
                            {{ $item->is_published ? 'En ligne' : 'Brouillon' }}
                        </span>
                    </div>
                @empty
                    <p class="py-6 text-sm text-ink/50">Aucun projet.</p>
                @endforelse
            </div>
        </article>

        <article class="admin-panel xl:col-span-1">
            <div class="mb-2 flex items-center justify-between gap-4">
                <h3 class="font-display text-xl font-bold tracking-[-0.04em]">Postes ouverts</h3>
                <a href="{{ route('admin.jobs.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Gérer</a>
            </div>
            <div>
                @forelse ($latestJobs as $job)
                    <div class="admin-activity-item">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-ink/80">{{ $job->title }}</p>
                            <p class="mt-1 text-xs text-ink/45">{{ $job->location ?: 'Localisation à préciser' }}</p>
                        </div>
                        <span class="admin-status admin-status-warning">Actif</span>
                    </div>
                @empty
                    <p class="py-6 text-sm text-ink/50">Aucun poste ouvert actuellement.</p>
                @endforelse
            </div>
        </article>
    </section>
</div>
@endsection
