@extends('layouts.admin')

@section('title', 'Témoignages')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $testimonials->total() }} témoignage(s)</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Ajouter un témoignage</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Auteur</th>
                <th class="px-4 py-3">Poste</th>
                <th class="px-4 py-3">Ordre</th>
                <th class="px-4 py-3">Statut</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($testimonials as $testimonial)
                <tr>
                    <td class="px-4 py-3">{{ $testimonial->full_name }}</td>
                    <td class="px-4 py-3">{{ $testimonial->position }}</td>
                    <td class="px-4 py-3">{{ $testimonial->order }}</td>
                    <td class="px-4 py-3">{{ $testimonial->is_published ? 'Publié' : 'Masqué' }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-primary-600 hover:underline">Modifier</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline" onsubmit="return confirm('Supprimer ce témoignage ?');">
                            @csrf @method('DELETE')
                            <button class="text-clay-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-500">Aucun témoignage pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $testimonials->links() }}</div>

@endsection
