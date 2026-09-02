<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GRIDD Consulting et Services')</title>
    <meta name="description" content="@yield('meta_description', "Bureau d'études en évaluations environnementales et sociales, maîtrise d'œuvre et exécution de travaux, au Bénin et en Afrique de l'Ouest.")">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper text-ink">

    <x-site-header />

    @if (session('status'))
        <div class="container-content mt-6">
            <div class="bg-primary-50 border border-primary-300 text-primary-700 text-sm px-4 py-3 rounded-sm">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <x-site-footer />

</body>
</html>
