@props(['project' => null])

<div class="flex flex-wrap gap-5 mb-5">
    <div class="w-full md:w-[calc(60%-10px)]">
        <label class="block text-sm mb-2">Titre du projet</label>
        <input name="title" value="{{ old('title', $project->title ?? '') }}" required
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="w-full md:w-[calc(40%-10px)]">
        <label class="block text-sm mb-2">Pays d'intervention</label>
        <input name="country" value="{{ old('country', $project->country ?? '') }}" required
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
</div>

<div class="flex flex-wrap gap-5 mb-5">
    <div class="w-full md:w-[calc(50%-10px)]">
        <label class="block text-sm mb-2">Client / partenaire</label>
        <input name="client" value="{{ old('client', $project->client ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="w-full md:w-[calc(50%-10px)]">
        <label class="block text-sm mb-2">Année</label>
        <input type="number" name="year" value="{{ old('year', $project->year ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Description</label>
    <textarea name="description" rows="6"
              class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">{{ old('description', $project->description ?? '') }}</textarea>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Ajouter des photos</label>
    <input type="file" name="photos[]" multiple accept="image/*"
           class="w-full border border-stone-200 rounded-sm px-4 py-3">
    <p class="text-xs text-stone-500 mt-1">Vous pouvez sélectionner plusieurs photos à la fois.</p>
</div>

@if ($project && $project->images->isNotEmpty())
    <div class="mb-5">
        <label class="block text-sm mb-2">Photos actuelles</label>
        <div class="flex flex-wrap gap-3">
            @foreach ($project->images as $image)
                <div class="relative w-28 h-28">
                    <img src="{{ asset('storage/'.$image->path) }}" class="w-full h-full object-cover rounded-sm">
                    <form method="POST" action="{{ route('admin.projects.images.destroy', $image) }}" onsubmit="return confirm('Supprimer cette photo ?');" class="absolute top-1 right-1">
                        @csrf @method('DELETE')
                        <button class="bg-ink/80 text-paper text-xs w-6 h-6 rounded-full">✕</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endif

<label class="flex items-center gap-2 text-sm mb-6">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published ?? true) ? 'checked' : '' }}>
    Publier ce projet sur le site public
</label>
