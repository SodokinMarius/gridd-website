@extends('layouts.admin')

@section('title', "Modifier l'utilisateur")

@section('content')

<form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white border border-stone-200 rounded-sm p-6 max-w-xl">
    @csrf
    @method('PUT')
    <div class="mb-5">
        <label class="block text-sm mb-2">Nom complet</label>
        <input name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="mb-5">
        <label class="block text-sm mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="mb-5">
        <label class="block text-sm mb-2">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
        <input type="password" name="password" class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="mb-6">
        <label class="block text-sm mb-2">Rôle</label>
        <select name="role" class="w-full border border-stone-200 rounded-sm px-4 py-3">
            <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Éditeur (gestion de contenu)</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur (accès total)</option>
        </select>
    </div>
    <button type="submit" class="btn-primary">Enregistrer les modifications</button>
</form>

@endsection
