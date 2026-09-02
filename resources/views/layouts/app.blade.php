<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GRIDD Consulting et Services')</title>
    <meta name="description" content="@yield('meta_description', "Bureau d'études en évaluations environnementales et sociales, maîtrise d'œuvre et exécution de travaux, au Bénin et en Afrique de l'Ouest.")">
    <meta name="theme-color" content="#10201A">

    <link rel="preconnect" href="https://fonts.googleapis.com">
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

    <main id="main-content">
        @yield('content')
    </main>

    <x-site-footer />

</body>
</html>