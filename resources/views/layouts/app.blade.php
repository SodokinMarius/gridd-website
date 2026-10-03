<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GRIDD Consulting et Services')</title>
    <meta name="description" content="@yield('meta_description', "Bureau d'études en évaluations environnementales et sociales, maîtrise d'œuvre et exécution de travaux, au Bénin et partout en Afrique.")">
    <meta name="theme-color" content="#10201A">

    {{-- Icône d'onglet --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('icon-512.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Aperçu lors du partage du lien (WhatsApp, Facebook, LinkedIn, X...) --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="GRIDD Consulting et Services">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'GRIDD Consulting et Services')">
    <meta property="og:description" content="@yield('meta_description', "Bureau d'études en évaluations environnementales et sociales, maîtrise d'œuvre et exécution de travaux, au Bénin et partout en Afrique.")">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
        <meta name="twitter:image" content="@yield('og_image')">
    @else
        {{-- Capture de la page d'accueil (1200×630) --}}
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">
    @endif
    <meta property="og:image:alt" content="@yield('title', 'GRIDD Consulting et Services')">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-body">

    <a href="#main-content" class="skip-link">Aller au contenu</a>

    <x-site-header />

    @if (session('status'))
        <div class="container-content fixed-alert">
            <div class="alert-success">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <main id="main-content" class="page-transition">
        @yield('content')
    </main>

    <x-site-footer />

</body>
</html>