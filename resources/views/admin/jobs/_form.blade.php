@props(['job' => null])

<div class="mb-5">
    <label class="block text-sm mb-2">Intitulé du poste</label>
    <input name="title" value="{{ old('title', $job->title ?? '') }}" required
           class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
</div>

<div class="flex flex-wrap gap-5 mb-5">
    <div class="w-full md:w-[calc(33.333%-14px)]">
        <label class="block text-sm mb-2">Type de contrat</label>
        <input name="contract_type" value="{{ old('contract_type', $job->contract_type ?? '') }}" placeholder="CDI, CDD, Consultance..."
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="w-full md:w-[calc(33.333%-14px)]">
        <label class="block text-sm mb-2">Lieu</label>
        <input name="location" value="{{ old('location', $job->location ?? '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
    <div class="w-full md:w-[calc(33.333%-14px)]">
        <label class="block text-sm mb-2">Date limite de candidature</label>
        <input type="date" name="deadline" value="{{ old('deadline', isset($job->deadline) ? $job->deadline?->format('Y-m-d') : '') }}"
               class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">
    </div>
</div>

<div class="mb-5">
    <label class="block text-sm mb-2">Description du poste</label>
    <textarea name="description" rows="8" required
              class="w-full border border-stone-200 rounded-sm px-4 py-3 focus:border-ink outline-none">{{ old('description', $job->description ?? '') }}</textarea>
</div>

<label class="flex items-center gap-2 text-sm mb-6">
    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $job->is_published ?? true) ? 'checked' : '' }}>
    Publier cette offre
</label>
