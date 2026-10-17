<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Administration GRIDD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        @if ($connectedUser)
            <div class="bg-primary-50 border border-primary-300 text-ink/80 text-sm px-4 py-4 rounded-sm">
                <p>Vous êtes connecté en tant que <strong>{{ $connectedUser->name }}</strong> ({{ $connectedUser->email }}).</p>
                <p class="mt-2">Ce lien est destiné au compte <strong>{{ $email }}</strong>. Déconnectez-vous pour vous connecter avec ce compte.</p>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="switch_to" value="{{ $email }}">
                    <button type="submit" class="btn-primary w-full justify-center">Se déconnecter et continuer</button>
                </form>
                <a href="{{ route('admin.dashboard') }}" class="mt-3 block text-center text-sm text-ink/60 hover:text-ink">Rester connecté en tant que {{ $connectedUser->name }}</a>
            </div>
        @else
        <form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-2" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required @unless (old('email', $email)) autofocus @endunless
                       class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
            </div>
            <div>
                <label class="block text-sm mb-2" for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required @if (old('email', $email)) autofocus @endif
                       class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
            </div>
            <label class="flex items-center gap-2 text-sm text-stone-600">
                <input type="checkbox" name="remember"> Se souvenir de moi
            </label>
            <button type="submit" class="btn-primary w-full justify-center">Se connecter</button>
        </form>
        @endif
    </div>
</body>
</html>
