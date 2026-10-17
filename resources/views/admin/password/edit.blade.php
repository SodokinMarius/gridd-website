@extends('layouts.admin')

@section('title', 'Mon mot de passe')

@section('content')

<div class="max-w-xl">
    @if (auth()->user()->must_change_password)
        <div class="alert-error mb-6">
            <strong class="block">Choisissez votre propre mot de passe.</strong>
            Le mot de passe actuel vous a été communiqué par un administrateur. Remplacez-le pour accéder à l’espace d’administration.
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}" class="admin-panel">
        @csrf
        @method('PUT')

        <div class="form-field mb-5">
            <label for="current_password">Mot de passe actuel</label>
            <input id="current_password" type="password" name="current_password" required autocomplete="current-password">
        </div>

        <div class="form-field mb-5">
            <label for="password">Nouveau mot de passe</label>
            <input id="password" type="password" name="password" required minlength="8" autocomplete="new-password">
            <p class="mt-1 text-xs text-ink/45">Au moins 8 caractères, dont une lettre et un chiffre.</p>
        </div>

        <div class="form-field mb-6">
            <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password">
        </div>

        <button type="submit" class="btn-primary">Enregistrer le mot de passe</button>
    </form>
</div>

@endsection
