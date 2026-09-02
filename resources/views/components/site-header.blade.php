@php
    $links = [
        ['label' => 'Accueil', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'À propos', 'url' => route('about'), 'active' => request()->routeIs('about')],
        ['label' => 'Services', 'url' => route('services'), 'active' => request()->routeIs('services')],
        ['label' => 'Réalisations', 'url' => route('projects.index'), 'active' => request()->routeIs('projects.*')],
        ['label' => 'Galerie', 'url' => route('gallery.index'), 'active' => request()->routeIs('gallery.*')],
        ['label' => 'Actualités', 'url' => route('news.index'), 'active' => request()->routeIs('news.*')],
        ['label' => 'Carrières', 'url' => route('jobs.index'), 'active' => request()->routeIs('jobs.*')],
    ];
@endphp

<header class="site-header" data-site-header>
    <div class="container-content">
        <div class="header-shell">
            <div class="header-row">
                <a href="{{ route('home') }}" class="brand-link" aria-label="Accueil GRIDD Consulting et Services">
                    <span class="brand-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="GRIDD Consulting et Services">
                    </span>
                    <span class="brand-copy">
                        <span class="brand-name">GRIDD</span>
                        <span class="brand-subtitle">Consulting & Services</span>
                    </span>
                </a>

                <nav class="desktop-nav" aria-label="Navigation principale">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" class="nav-link {{ $link['active'] ? 'nav-link-active' : '' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('contact') }}" class="header-cta">
                        Nous contacter
                    </a>
                </div>

                <button type="button" class="menu-button" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu">
                    <span class="sr-only">Ouvrir le menu</span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </button>
            </div>

            <div id="mobile-menu" class="mobile-panel" data-mobile-menu>
                <nav class="mobile-nav" aria-label="Navigation mobile">
                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" class="mobile-nav-link {{ $link['active'] ? 'mobile-nav-link-active' : '' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    <a href="{{ route('contact') }}" class="mobile-cta">
                        Nous contacter
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>