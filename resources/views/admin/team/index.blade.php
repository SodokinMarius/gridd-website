@extends('layouts.admin')

@section('title', 'Équipe')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $members->total() }} membre(s)</p>
    <a href="{{ route('admin.team.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Ajouter un membre</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Nom</th>
                <th class="px-4 py-3">Poste</th>
                <th class="px-4 py-3">Ordre</th>
                <th class="px-4 py-3">Statut</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($members as $member)
                <tr>
                    <td class="px-4 py-3">{{ $member->full_name }}</td>
                    <td class="px-4 py-3">{{ $member->position }}</td>
                    <td class="px-4 py-3">{{ $member->order }}</td>
                    <td class="px-4 py-3">{{ $member->is_published ? 'Publié' : 'Masqué' }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.team.edit', $member) }}" class="text-primary-600 hover:underline">Modifier</a>
                        <form method="POST" action="{{ route('admin.team.destroy', $member) }}" class="inline" onsubmit="return confirm('Supprimer ce membre ?');">
                            @csrf @method('DELETE')
                            <button class="text-clay-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-500">Aucun membre pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $members->links() }}</div>

@endsection
