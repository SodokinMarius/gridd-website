@extends('layouts.admin')

@section('title', 'Réalisations')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $projects->total() }} projet(s)</p>
    <a href="{{ route('admin.projects.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Nouveau projet</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Titre</th>
                <th class="px-4 py-3">Pays</th>
                <th class="px-4 py-3">Année</th>
                <th class="px-4 py-3">Statut</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($projects as $project)
                <tr>
                    <td class="px-4 py-3">{{ $project->title }}</td>
                    <td class="px-4 py-3">{{ $project->country }}</td>
                    <td class="px-4 py-3">{{ $project->year }}</td>
                    <td class="px-4 py-3">{{ $project->is_published ? 'Publié' : 'Brouillon' }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-primary-600 hover:underline">Modifier</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline" onsubmit="return confirm('Supprimer ce projet ?');">
                            @csrf @method('DELETE')
                            <button class="text-clay-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-500">Aucun projet pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $projects->links() }}</div>

@endsection
