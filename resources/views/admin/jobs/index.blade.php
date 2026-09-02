@extends('layouts.admin')

@section('title', 'Postes vacants')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $jobs->total() }} offre(s)</p>
    <a href="{{ route('admin.jobs.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Nouvelle offre</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Titre</th>
                <th class="px-4 py-3">Type</th>
                <th class="px-4 py-3">Date limite</th>
                <th class="px-4 py-3">Statut</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($jobs as $job)
                <tr>
                    <td class="px-4 py-3">{{ $job->title }}</td>
                    <td class="px-4 py-3">{{ $job->contract_type }}</td>
                    <td class="px-4 py-3">{{ $job->deadline?->format('d/m/Y') ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @if (!$job->is_published)
                            Brouillon
                        @elseif ($job->isExpired())
                            Expirée
                        @else
                            Active
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.jobs.edit', $job) }}" class="text-primary-600 hover:underline">Modifier</a>
                        <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" class="inline" onsubmit="return confirm('Supprimer cette offre ?');">
                            @csrf @method('DELETE')
                            <button class="text-clay-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-500">Aucune offre pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $jobs->links() }}</div>

@endsection
