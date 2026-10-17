@extends('layouts.admin')

@section('title', 'Nouvel utilisateur')

@section('content')

<form method="POST" action="{{ route('admin.users.store') }}" class="bg-white border border-stone-200 rounded-sm p-6 max-w-xl">
    @csrf
    <div class="mb-5">
        <label class="block text-sm mb-2">Nom complet</label>
        <input name="name" value="{{ old('name') }}" required class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="mb-5">
        <label class="block text-sm mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="mb-5">
        <label class="block text-sm mb-2">Mot de passe provisoire</label>
        <input type="password" name="password" required class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
        <p class="mt-1 text-xs text-ink/45">Communiquez-le à l’utilisateur : il devra le remplacer par son propre mot de passe à sa première connexion.</p>
    </div>
    <div class="mb-6">
        <label class="block text-sm mb-2">Rôle</label>
        <select name="role" class="w-full border border-stone-200 rounded-sm px-4 py-3">
            <option value="editor">Éditeur (gestion de contenu)</option>
            <option value="admin">Administrateur (accès total)</option>
        </select>
    </div>
    <label class="mb-6 flex items-start gap-3 text-sm">
        <input type="checkbox" name="send_credentials" value="1" class="mt-0.5" {{ old('send_credentials', true) ? 'checked' : '' }}>
        <span>Envoyer ses identifiants par email<span class="block text-xs text-ink/45">L’utilisateur reçoit son identifiant, le mot de passe provisoire et le lien de connexion.</span></span>
    </label>
    <button type="submit" class="btn-primary">Créer l'utilisateur</button>
</form>

@endsection
