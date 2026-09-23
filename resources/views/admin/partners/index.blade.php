@extends('layouts.admin')

@section('title', 'Partenaires')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-end">
    <div>
        <p class="eyebrow mb-3">Présence institutionnelle</p>
        <h2 class="font-display text-3xl font-bold tracking-[-0.05em] md:text-4xl">Partenaires</h2>
        <p class="mt-3 text-sm leading-6 text-ink/55">Les organisations affichées dans la section partenaires de l’accueil.</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="btn-primary">Ajouter un partenaire <span aria-hidden="true">＋</span></a>
</div>

<div class="admin-panel overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[700px] text-sm">
            <thead class="bg-stone-50 text-left text-xs font-bold uppercase tracking-[0.12em] text-ink/45">
                <tr>
                    <th class="px-5 py-4">Partenaire</th>
                    <th class="px-5 py-4">Lien</th>
                    <th class="px-5 py-4">Ordre</th>
                    <th class="px-5 py-4">Statut</th>
                    <th class="px-5 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink/[7%]">
                @forelse ($partners as $partner)
                    <tr class="transition-colors hover:bg-stone-50/80">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-12 w-16 items-center justify-center overflow-hidden rounded-xl bg-stone-100 p-2">
                                    @if ($partner->logo)
                                        <img src="{{ \App\Support\Media::url($partner->logo) }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain">
                                    @else
                                        <span class="font-display text-lg font-bold text-ink/30">{{ mb_strtoupper(mb_substr($partner->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <span class="font-semibold text-ink/80">{{ $partner->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-ink/55">
                            @if ($partner->url)
                                <a href="{{ $partner->url }}" target="_blank" rel="noopener" class="max-w-xs truncate text-primary-700 hover:underline">{{ $partner->url }}</a>
                            @else
                                Non renseigné
                            @endif
                        </td>
                        <td class="px-5 py-4 font-display font-bold text-ink/65">{{ $partner->order }}</td>
                        <td class="px-5 py-4">
                            <span class="admin-status {{ $partner->is_published ? 'admin-status-published' : 'admin-status-draft' }}">
                                {{ $partner->is_published ? 'Publié' : 'Masqué' }}
                            </span>
                        </td>
                        <td class="space-x-3 px-5 py-4 text-right">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="font-semibold text-primary-700 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" class="inline" onsubmit="return confirm('Supprimer ce partenaire ?');">
                                @csrf @method('DELETE')
                                <button class="font-semibold text-clay-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-sm text-ink/50">Aucun partenaire pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $partners->links() }}</div>
@endsection
