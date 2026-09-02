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
        <label class="block text-sm mb-2">Mot de passe</label>
        <input type="password" name="password" required class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="mb-6">
        <label class="block text-sm mb-2">Rôle</label>
        <select name="role" class="w-full border border-stone-200 rounded-sm px-4 py-3">
            <option value="editor">Éditeur (gestion de contenu)</option>
            <option value="admin">Administrateur (accès total)</option>
        </select>
    </div>
    <button type="submit" class="btn-primary">Créer l'utilisateur</button>
</form>

@endsection
