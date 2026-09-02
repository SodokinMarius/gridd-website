<header class="site-header" data-site-header>
    <div class="container-content flex items-center justify-between py-4">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="GRIDD Consulting et Services" class="h-10 w-auto">
        </a>
        <nav class="hidden lg:flex items-center gap-8">
            <a href="{{ route('home') }}" class="nav-link">Accueil</a>
            <a href="{{ route('about') }}" class="nav-link">À propos</a>
            <a href="{{ route('about') }}#equipe" class="nav-link">Équipe</a>
            <a href="{{ route('services') }}" class="nav-link">Services</a>
            <a href="{{ route('projects.index') }}" class="nav-link">Réalisations</a>
            <a href="{{ route('gallery.index') }}" class="nav-link">Galerie</a>
            <a href="{{ route('news.index') }}" class="nav-link">Actualités</a>
            <a href="{{ route('jobs.index') }}" class="nav-link">Postes vacants</a>
        </nav>
        <a href="{{ route('contact') }}" class="btn-primary !py-2.5 !px-5 text-sm">Nous contacter</a>
    </div>
</header>
