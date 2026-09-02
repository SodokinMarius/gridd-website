@props(['news' => null])

<div class="mb-5">
    <label class="block text-sm mb-2">Titre</label>
    <input name="title" value="{{ old('title', $news->title ?? '') }}" required
           class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Contenu</label>
    <textarea name="content" rows="10" required
              class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">{{ old('content', $news->content ?? '') }}</textarea>
    <p class="text-xs text-stone-500 mt-1">Astuce : un éditeur de texte riche (ex. TinyMCE) peut être ajouté ici ultérieurement.</p>
</div>

<div class="flex flex-wrap gap-5 mb-5">
    <div class="w-full md:w-[calc(50%-10px)]">
        <label class="block text-sm mb-2">Image de couverture</label>
        <input type="file" name="cover_image" accept="image/*"
               class="w-full border border-stone-200 rounded-sm px-4 py-3">
        @if (($news->cover_image ?? null))
            <img src="{{ asset('storage/'.$news->cover_image) }}" class="w-32 h-20 object-cover rounded-sm mt-2">
        @endif
    </div>
    <div class="w-full md:w-[calc(50%-10px)]">
        <label class="block text-sm mb-2">Date de publication (laisser vide pour immédiat)</label>
        <input type="datetime-local" name="published_at"
               value="{{ old('published_at', isset($news->published_at) ? $news->published_at?->format('Y-m-d\TH:i') : '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
        <p class="text-xs text-stone-500 mt-1">Une date future permet de programmer la publication.</p>
    </div>
</div>

<label class="flex items-center gap-2 text-sm mb-6">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published ?? true) ? 'checked' : '' }}>
    Publier cette actualité
</label>
