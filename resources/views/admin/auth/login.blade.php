<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Administration GRIDD</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-ink min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-sm bg-white rounded-sm p-8">
        <img src="{{ asset('images/logo.png') }}" alt="GRIDD" class="h-10 w-auto mb-8">
        <h1 class="font-display font-semibold text-xl mb-6">Espace d'administration</h1>

        @if ($errors->any())
            <div class="bg-clay-50 border border-clay-300 text-clay-600 text-sm px-4 py-3 rounded-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-2" for="email">Email</label>
                <input id="email" type="email" name="email" required autofocus
                       class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
            </div>
            <div>
                <label class="block text-sm mb-2" for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required
                       class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
            </div>
            <label class="flex items-center gap-2 text-sm text-stone-600">
                <input type="checkbox" name="remember"> Se souvenir de moi
            </label>
            <button type="submit" class="btn-primary w-full justify-center">Se connecter</button>
        </form>
    </div>
</body>
</html>
