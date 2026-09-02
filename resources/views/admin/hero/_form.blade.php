@props(['slide' => null])

<div class="mb-5">
    <label class="block text-sm mb-2">Image de fond *</label>
    <input type="file" name="image" accept="image/*" {{ $slide ? '' : 'required' }}
           class="w-full border border-stone-200 rounded-sm px-4 py-3">
    @if (($slide->image ?? null))
        <img src="{{ \App\Support\Media::url($slide->image) }}" class="w-full max-w-md h-40 object-cover rounded-sm mt-2">
    @endif
    <p class="text-xs text-stone-500 mt-1">Format paysage recommandé (1920×1080 px).</p>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Surtitre (eyebrow)</label>
    <input name="eyebrow" value="{{ old('eyebrow', $slide->eyebrow ?? '') }}"
           class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none"
           placeholder="Ex. Bureau d'études — Bénin">
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Titre principal *</label>
    <input name="title" value="{{ old('title', $slide->title ?? '') }}" required
           class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Sous-titre</label>
    <textarea name="subtitle" rows="3"
              class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea>
</div>

<div class="form-row mb-5">
    <div class="form-field">
        <label>Texte du bouton</label>
        <input name="button_text" value="{{ old('button_text', $slide->button_text ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none"
               placeholder="Ex. Découvrir nos services">
    </div>
    <div class="form-field">
        <label>Lien du bouton</label>
        <input name="button_url" value="{{ old('button_url', $slide->button_url ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none"
               placeholder="Ex. /services">
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Ordre d'affichage</label>
    <input type="number" name="order" min="0" value="{{ old('order', $slide->order ?? 0) }}"
           class="w-32 border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
</div>

<label class="flex items-center gap-2 text-sm mb-6">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $slide->is_published ?? true) ? 'checked' : '' }}>
    Publier cette slide
</label>
