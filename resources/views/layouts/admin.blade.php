<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — GRIDD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 text-ink font-body">
<div class="flex min-h-screen">

    <aside class="w-64 bg-ink text-paper/80 flex-shrink-0 hidden md:flex flex-col">
        <div class="p-6 border-b border-paper/10">
            <img src="{{ asset('images/logo.png') }}" alt="GRIDD" class="h-8 w-auto brightness-0 invert opacity-90">
        </div>
        <nav class="flex-1 p-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-paper/10 text-paper' : '' }}">Tableau de bord</a>
            <a href="{{ route('admin.hero.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.hero.*') ? 'bg-paper/10 text-paper' : '' }}">Bannière accueil</a>
            <a href="{{ route('admin.projects.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-paper/10 text-paper' : '' }}">Réalisations</a>
            <a href="{{ route('admin.gallery.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-paper/10 text-paper' : '' }}">Galerie</a>
            <a href="{{ route('admin.news.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-paper/10 text-paper' : '' }}">Actualités</a>
            <a href="{{ route('admin.jobs.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.jobs.*') ? 'bg-paper/10 text-paper' : '' }}">Postes vacants</a>
            <a href="{{ route('admin.team.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.team.*') ? 'bg-paper/10 text-paper' : '' }}">Équipe</a>
            <a href="{{ route('admin.testimonials.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-paper/10 text-paper' : '' }}">Témoignages</a>
            @if (auth()->user()?->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-sm hover:bg-paper/10 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-paper/10 text-paper' : '' }}">Utilisateurs</a>
            @endif
        </nav>
        <div class="p-4 border-t border-paper/10">
            <a href="{{ route('home') }}" target="_blank" class="block px-3 py-2 text-sm hover:text-paper transition-colors">Voir le site public ↗</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 text-sm hover:text-paper transition-colors">Se déconnecter</button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-stone-200 px-6 py-4 flex items-center justify-between">
            <h1 class="font-display font-semibold text-lg">@yield('title', 'Tableau de bord')</h1>
            <span class="text-sm text-stone-600">{{ auth()->user()?->name }} · {{ auth()->user()?->isAdmin() ? 'Administrateur' : 'Éditeur' }}</span>
        </header>

        <main class="p-6 flex-1">
            @if (session('status'))
                <div class="bg-primary-50 border border-primary-300 text-primary-700 text-sm px-4 py-3 rounded-sm mb-6">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-clay-50 border border-clay-300 text-clay-600 text-sm px-4 py-3 rounded-sm mb-6">
                    <ul class="list-disc list-inside">
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
