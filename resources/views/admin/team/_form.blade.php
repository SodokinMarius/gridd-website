@props(['member' => null])

<div class="form-row mb-5">
    <div class="form-field">
        <label>Prénom</label>
        <input name="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" required
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="form-field">
        <label>Nom</label>
        <input name="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" required
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Poste</label>
    <input name="position" value="{{ old('position', $member->position ?? '') }}" required
           class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Photo</label>
    <input type="file" name="photo" accept="image/*"
           class="w-full border border-stone-200 rounded-sm px-4 py-3">
    @if (($member->photo ?? null))
        <img src="{{ \App\Support\Media::url($member->photo) }}" class="w-24 h-24 object-cover rounded-sm mt-2">
    @endif
</div>

<div class="form-row mb-5">
    <div class="form-field">
        <label>LinkedIn (URL)</label>
        <input name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="form-field">
        <label>WhatsApp (lien wa.me)</label>
        <input name="whatsapp_url" value="{{ old('whatsapp_url', $member->whatsapp_url ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Ordre d'affichage</label>
    <input type="number" name="order" min="0" value="{{ old('order', $member->order ?? 0) }}"
           class="w-32 border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
</div>

<label class="flex items-center gap-2 text-sm mb-6">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $member->is_published ?? true) ? 'checked' : '' }}>
    Publier ce membre
</label>
