@extends('layouts.admin')

@section('title', 'Ajouter des photos')

@section('content')

<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-2xl">
    @csrf

    <div class="mb-5">
        <label class="block text-sm mb-2">Photos (sélection multiple possible)</label>
        <input type="file" name="photos[]" multiple accept="image/*" required
               class="w-full border border-stone-200 rounded-sm px-4 py-3">
    </div>

    <div class="flex flex-wrap gap-5 mb-6">
        <div class="w-full md:w-[calc(50%-10px)]">
            <label class="block text-sm mb-2">Catégorie</label>
            <select name="category" class="w-full border border-stone-200 rounded-sm px-4 py-3">
                <option value="">Non classée</option>
                <option value="chantier">Chantier</option>
                <option value="equipement">Équipement</option>
                <option value="mission">Mission terrain</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div class="w-full md:w-[calc(50%-10px)]">
            <label class="block text-sm mb-2">Lier à un projet (optionnel)</label>
            <select name="project_id" class="w-full border border-stone-200 rounded-sm px-4 py-3">
                <option value="">Aucun</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn-primary">Ajouter à la galerie</button>
</form>

@endsection
