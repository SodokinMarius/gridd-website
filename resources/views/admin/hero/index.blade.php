@extends('layouts.admin')

@section('title', 'Bannière accueil')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $slides->total() }} slide(s) — carrousel page d'accueil</p>
    <a href="{{ route('admin.hero.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Ajouter une slide</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="admin-table w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Aperçu</th>
                <th class="px-4 py-3">Titre</th>
                <th class="px-4 py-3">Ordre</th>
                <th class="px-4 py-3">Statut</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($slides as $slide)
                <tr>
                    <td class="px-4 py-3">
                        <img src="{{ \App\Support\Media::url($slide->image) }}" class="w-20 h-12 object-cover rounded-sm">
                    </td>
                    <td class="px-4 py-3">{{ $slide->title }}</td>
                    <td class="px-4 py-3">{{ $slide->order }}</td>
                    <td class="px-4 py-3">{{ $slide->is_published ? 'Publiée' : 'Masquée' }}</td>
                    <td class="px-4 py-3">
                        <div class="admin-row-actions">
                            <x-admin.edit-link :href="route('admin.hero.edit', $slide)" />
                            <x-admin.delete-button :action="route('admin.hero.destroy', $slide)" message="Supprimer la slide « {{ $slide->title }} » ?" />
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-500">Aucune slide. Ajoutez-en pour alimenter le carrousel.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $slides->links() }}</div>

@endsection
