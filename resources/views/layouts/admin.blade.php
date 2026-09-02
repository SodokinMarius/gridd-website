@php
    $contentLinks = [
        ['label' => 'Bannière accueil', 'route' => 'admin.hero.index', 'pattern' => 'admin.hero.*'],
        ['label' => 'Réalisations', 'route' => 'admin.projects.index', 'pattern' => 'admin.projects.*'],
        ['label' => 'Partenaires', 'route' => 'admin.partners.index', 'pattern' => 'admin.partners.*'],
        ['label' => 'Galerie', 'route' => 'admin.gallery.index', 'pattern' => 'admin.gallery.*'],
        ['label' => 'Actualités', 'route' => 'admin.news.index', 'pattern' => 'admin.news.*'],
    ];

    $organizationLinks = [
        ['label' => 'Postes vacants', 'route' => 'admin.jobs.index', 'pattern' => 'admin.jobs.*'],
        ['label' => 'Équipe', 'route' => 'admin.team.index', 'pattern' => 'admin.team.*'],
        ['label' => 'Témoignages', 'route' => 'admin.testimonials.index', 'pattern' => 'admin.testimonials.*'],
    ];
@endphp

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — GRIDD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell text-ink font-body">
<div class="flex min-h-screen">

    <aside class="admin-sidebar hidden w-72 flex-shrink-0 flex-col text-paper/80 lg:flex">
        <div class="border-b border-paper/10 px-6 py-7">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" aria-label="Tableau de bord GRIDD">
                <span class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-lg">
                    <img src="{{ asset('images/logo.png') }}" alt="GRIDD" class="h-8 w-auto object-contain">
                </span>
                <span>
                    <strong class="block font-display text-lg tracking-[-0.04em] text-paper">GRIDD</strong>
                    <span class="mt-1 block text-[0.65rem] font-bold uppercase tracking-[0.18em] text-paper/45">Administration</span>
                </span>
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-6 text-sm" aria-label="Navigation d’administration">
            <p class="mb-3 px-3 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-paper/35">Pilotage</p>
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'admin-nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 13h6V4H4v9Zm10 7h6V4h-6v16ZM4 20h6v-3H4v3Z"/></svg>
                Tableau de bord
            </a>

            <p class="mb-3 mt-8 px-3 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-paper/35">Contenus</p>
            <div class="space-y-1">
                @foreach ($contentLinks as $link)
                    @if (\Illuminate\Support\Facades\Route::has($link['route']))
                        <a href="{{ route($link['route']) }}" class="admin-nav-link {{ request()->routeIs($link['pattern']) ? 'admin-nav-link-active' : '' }}">
                            <span class="admin-nav-dot"></span>
                            {{ $link['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>

            <p class="mb-3 mt-8 px-3 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-paper/35">Organisation</p>
            <div class="space-y-1">
                @foreach ($organizationLinks as $link)
                    @if (\Illuminate\Support\Facades\Route::has($link['route']))
                        <a href="{{ route($link['route']) }}" class="admin-nav-link {{ request()->routeIs($link['pattern']) ? 'admin-nav-link-active' : '' }}">
                            <span class="admin-nav-dot"></span>
                            {{ $link['label'] }}
                        </a>
                    @endif
                @endforeach
                @if (auth()->user()?->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'admin-nav-link-active' : '' }}">
                        <span class="admin-nav-dot"></span>
                        Utilisateurs
                    </a>
                @endif
            </div>
        </nav>

        <div class="border-t border-paper/10 p-4">
            <div class="mb-3 rounded-2xl border border-paper/10 bg-white/5 p-3">
                <p class="truncate text-sm font-semibold text-paper">{{ auth()->user()?->name }}</p>
                <p class="mt-1 text-xs text-paper/45">{{ auth()->user()?->isAdmin() ? 'Administrateur' : 'Éditeur' }}</p>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="admin-bottom-link">Voir le site public <span>↗</span></a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="admin-bottom-link w-full text-left">Se déconnecter <span>→</span></button>
            </form>
        </div>
    </aside>

    <div class="flex min-w-0 flex-1 flex-col">
        <header class="admin-main-header px-5 py-4 md:px-8">
            <div class="flex items-center justify-between gap-5">
                <div>
                    <p class="mb-1 text-[0.68rem] font-bold uppercase tracking-[0.2em] text-primary-700">Espace sécurisé</p>
                    <h1 class="font-display text-xl font-bold tracking-[-0.04em] md:text-2xl">@yield('title', 'Tableau de bord')</h1>
                </div>
                <div class="hidden items-center gap-3 sm:flex">
                    <span class="rounded-full border border-primary-300/40 bg-primary-50 px-3 py-1.5 text-xs font-bold text-primary-700">{{ auth()->user()?->isAdmin() ? 'ADMIN' : 'ÉDITEUR' }}</span>
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-ink font-display font-bold text-paper">
                        {{ mb_strtoupper(mb_substr(auth()->user()?->name ?? 'G', 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="admin-page flex-1">
            @if (session('status'))
                <div class="alert-success mb-6">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert-error mb-6">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
