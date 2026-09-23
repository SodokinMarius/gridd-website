@extends('layouts.admin')

@section('title', 'Modifier un partenaire')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.partners.index') }}" class="text-sm font-semibold text-primary-700 hover:underline">← Retour aux partenaires</a>
    <p class="eyebrow mb-3 mt-8">Contenu existant</p>
    <h2 class="font-display text-3xl font-bold tracking-[-0.05em]">Modifier {{ $partner->name }}</h2>
</div>

<form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data" class="admin-panel max-w-4xl">
    @csrf @method('PUT')
    @include('admin.partners._form', ['partner' => $partner])
    <div class="flex flex-wrap gap-3 border-t border-ink/[7%] pt-6">
        <button class="btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('admin.partners.index') }}" class="btn-outline">Annuler</a>
    </div>
</form>
@endsection
