@extends('layouts.admin')

@section('title', 'Galerie')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $images->total() }} photo(s)</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Ajouter des photos</a>
</div>

<div class="flex flex-wrap gap-4">
    @forelse ($images as $image)
        <div class="w-full sm:w-[calc(33.333%-11px)] md:w-[calc(20%-13px)] bg-white border border-stone-200 rounded-sm overflow-hidden">
            <div class="aspect-square">
                <img src="{{ asset('storage/'.$image->path) }}" class="w-full h-full object-cover">
            </div>
            <div class="p-3">
                <p class="text-xs text-stone-500 mb-2 capitalize">{{ $image->category ?? 'Non classée' }}</p>
                <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Supprimer cette photo ?');">
                    @csrf @method('DELETE')
                    <button class="text-clay-500 text-xs hover:underline">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-stone-500 text-sm">Aucune photo pour le moment.</p>
    @endforelse
</div>

<div class="mt-6">{{ $images->links() }}</div>

@endsection
