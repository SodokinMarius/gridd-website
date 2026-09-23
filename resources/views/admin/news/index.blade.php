@extends('layouts.admin')

@section('title', 'Actualités')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $news->total() }} actualité(s)</p>
    <a href="{{ route('admin.news.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Nouvelle actualité</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Titre</th>
                <th class="px-4 py-3">Publication</th>
                <th class="px-4 py-3">Galerie</th>
                <th class="px-4 py-3">Statut</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($news as $article)
                <tr>
                    <td class="px-4 py-3">{{ $article->title }}</td>
                    <td class="px-4 py-3">{{ $article->published_at?->format('d/m/Y') ?? '—' }}</td>
                    <td class="px-4 py-3 text-ink/55">{{ $article->images->count() }} image(s)</td>
                    <td class="px-4 py-3">
                        @if (!$article->is_published)
                            Brouillon
                        @elseif ($article->published_at && $article->published_at->isFuture())
                            Programmée
                        @else
                            Publiée
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.news.edit', $article) }}" class="text-primary-600 hover:underline">Modifier</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $article) }}" class="inline" onsubmit="return confirm('Supprimer cette actualité ?');">
                            @csrf @method('DELETE')
                            <button class="text-clay-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-stone-500">Aucune actualité pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $news->links() }}</div>

@endsection
