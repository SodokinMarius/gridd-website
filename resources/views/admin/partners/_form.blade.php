@props(['partner' => null])

<div class="form-field mb-5">
    <label for="name">Nom du partenaire</label>
    <input id="name" name="name" value="{{ old('name', $partner->name ?? '') }}" required>
</div>

<div class="form-row mb-5">
    <div class="form-field">
        <label for="logo">Logo ou photo</label>
        <input id="logo" type="file" name="logo" accept="image/*">
        @if ($partner?->logo)
            <img src="{{ \App\Support\Media::url($partner->logo) }}" alt="{{ $partner->name }}" class="mt-3 h-20 w-32 rounded-xl bg-stone-100 object-contain p-2">
        @endif
        <p class="mt-1 text-xs text-ink/45">Format image, 4 Mo maximum.</p>
    </div>
    <div class="form-field">
        <label for="url">URL du site</label>
        <input id="url" type="url" name="url" value="{{ old('url', $partner->url ?? '') }}" placeholder="https://..."><p class="mt-1 text-xs text-ink/45">Le logo devient cliquable sur l’accueil.</p>
    </div>
</div>

<div class="mb-5">
    <label class="mb-2 block text-sm font-semibold text-ink/75" for="order">Ordre d’affichage</label>
    <input id="order" type="number" name="order" min="0" value="{{ old('order', $partner->order ?? 0) }}" class="max-w-[8rem]">
</div>

<label class="mb-6 flex items-center gap-3 text-sm font-semibold text-ink/75">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $partner->is_published ?? true) ? 'checked' : '' }}>
    Afficher ce partenaire sur le site public
</label>
