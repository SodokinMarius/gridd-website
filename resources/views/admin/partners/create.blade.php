@extends('layouts.admin')

@section('title', 'Ajouter un partenaire')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.partners.index') }}" class="text-sm font-semibold text-primary-700 hover:underline">← Retour aux partenaires</a>
    <p class="eyebrow mb-3 mt-8">Nouveau contenu</p>
    <h2 class="font-display text-3xl font-bold tracking-[-0.05em]">Ajouter un partenaire</h2>
</div>

<form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data" class="admin-panel max-w-4xl">
    @csrf
    @include('admin.partners._form')
    <div class="flex flex-wrap gap-3 border-t border-ink/[7%] pt-6">
        <button class="btn-primary">Enregistrer le partenaire</button>
        <a href="{{ route('admin.partners.index') }}" class="btn-outline">Annuler</a>
    </div>
</form>
@endsection
