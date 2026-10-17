@props(['news' => null])

<div class="mb-5">
    <label class="mb-2 block text-sm font-semibold text-ink/75" for="title">Titre</label>
    <input id="title" name="title" value="{{ old('title', $news->title ?? '') }}" required>
</div>

<div class="mb-5">
    <label class="mb-2 block text-sm font-semibold text-ink/75" for="content">Contenu</label>
    <textarea id="content" name="content" rows="10" required>{{ old('content', $news->content ?? '') }}</textarea>
    <p class="mt-1 text-xs text-ink/45">Astuce : un éditeur de texte riche peut être ajouté ici ultérieurement.</p>
</div>

<div class="form-row mb-6">
    <div class="form-field">
        <label for="cover_image">Image de couverture <span class="text-clay-600">*</span></label>
        <input id="cover_image" type="file" name="cover_image" accept="image/*" {{ !$news?->cover_image ? 'required' : '' }}>
        @if (($news->cover_image ?? null))
            <img src="{{ \App\Support\Media::url($news->cover_image) }}" alt="Couverture de {{ $news->title }}" class="mt-3 h-24 w-40 rounded-xl object-cover">
        @endif
        <p class="mt-1 text-xs text-ink/45">Obligatoire pour toute actualité. Affichée dans les cartes et en tête de l’article.</p>
    </div>
    <div class="form-field">
        <label for="published_at">Date de publication</label>
        <input id="published_at" type="datetime-local" name="published_at"
               value="{{ old('published_at', isset($news->published_at) ? $news->published_at?->format('Y-m-d\TH:i') : '') }}">
        <p class="mt-1 text-xs text-ink/45">Une date future programme la publication.</p>
    </div>
</div>

<div class="mb-6 rounded-2xl border border-primary-300/30 bg-primary-50/50 p-5">
    <label class="mb-2 block text-sm font-semibold text-ink/80" for="images">Images supplémentaires</label>
    <input id="images" type="file" name="images[]" accept="image/*" multiple>
    <p class="mt-2 text-xs leading-5 text-ink/55">Ajoutez une ou plusieurs images à la galerie de cette actualité. Jusqu’à 12 images, 4 Mo par fichier.</p>

    @if ($news?->images?->isNotEmpty())
        <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ($news->images as $image)
                <div class="group relative overflow-hidden rounded-xl bg-white">
                    <img src="{{ \App\Support\Media::url($image->path) }}" alt="{{ $image->caption ?: 'Image de '.$news->title }}" class="aspect-square w-full object-cover">
                    <x-admin.delete-button :action="route('admin.news.images.destroy', $image)" message="Supprimer cette image de l’actualité ?"
                        class="admin-icon-btn-overlay absolute right-2 top-2" />
                </div>
            @endforeach
        </div>
    @endif
</div>

<label class="mb-6 flex items-center gap-3 text-sm font-semibold text-ink/75">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published ?? true) ? 'checked' : '' }}>
    Publier cette actualité
</label>
