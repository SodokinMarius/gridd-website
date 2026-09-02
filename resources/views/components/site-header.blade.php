@php
    $links = [
        ['label' => 'Accueil', 'url' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'À propos', 'url' => route('about'), 'active' => request()->routeIs('about')],
        ['label' => 'Services', 'url' => route('services'), 'active' => request()->routeIs('services')],
        ['label' => 'Réalisations', 'url' => route('projects.index'), 'active' => request()->routeIs('projects.*')],
    ];

    $resourceLinks = [
        ['label' => 'Galerie', 'url' => route('gallery.index'), 'active' => request()->routeIs('gallery.*')],
        ['label' => 'Actualités', 'url' => route('news.index'), 'active' => request()->routeIs('news.*')],
        ['label' => 'Carrières', 'url' => route('jobs.index'), 'active' => request()->routeIs('jobs.*')],
    ];

    $resourcesActive = collect($resourceLinks)->contains('active', true);
@endphp

<header class="site-header" data-site-header>
    <div class="site-header-container">
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

                    <div class="nav-dropdown" data-submenu>
                        <button type="button"
                                class="nav-link nav-dropdown-trigger {{ $resourcesActive ? 'nav-link-active' : '' }}"
                                data-submenu-toggle
                                aria-expanded="false"
                                aria-haspopup="true">
                            Ressources
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="m4 6 4 4 4-4" />
                            </svg>
                        </button>
                        <div class="nav-dropdown-panel" data-submenu-panel>
                            @foreach ($resourceLinks as $link)
                                <a href="{{ $link['url'] }}" class="nav-dropdown-link {{ $link['active'] ? 'nav-dropdown-link-active' : '' }}">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </nav>

                <div class="header-actions">
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

                    <details class="mobile-menu-group" {{ $resourcesActive ? 'open' : '' }}>
                        <summary class="mobile-nav-link mobile-menu-summary">
                            <span>Ressources</span>
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="m4 6 4 4 4-4" />
                            </svg>
                        </summary>
                        <div class="mobile-submenu">
                            @foreach ($resourceLinks as $link)
                                <a href="{{ $link['url'] }}" class="mobile-nav-link {{ $link['active'] ? 'mobile-nav-link-active' : '' }}">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </details>

                    <a href="{{ route('contact') }}" class="mobile-cta">
                        Nous contacter
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
