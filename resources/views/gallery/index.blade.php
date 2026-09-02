@extends('layouts.app')

@section('title', 'Galerie — GRIDD Consulting et Services')

@section('content')

<section class="py-20 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Galerie</p>
        <h1 class="text-4xl md:text-5xl font-semibold">Le terrain, en images.</h1>
    </div>
</section>

<section class="py-16">
    <div class="container-content">
        @if ($categories->isNotEmpty())
        <div class="flex flex-wrap gap-3 mb-12">
            <a href="{{ route('gallery.index') }}"
               class="px-4 py-2 rounded-sm text-sm border {{ !$category ? 'bg-ink text-paper border-ink' : 'border-stone-200 text-ink/70 hover:border-ink' }} transition-colors">
                Tout
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('gallery.index', ['categorie' => $cat]) }}"
                   class="px-4 py-2 rounded-sm text-sm border capitalize {{ $category === $cat ? 'bg-ink text-paper border-ink' : 'border-stone-200 text-ink/70 hover:border-ink' }} transition-colors">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
        @endif

        @if ($images->isEmpty())
            <p class="text-ink/60">Aucune photo publiée pour le moment.</p>
        @else
            <div class="flex flex-wrap gap-4 mb-12">
                @foreach ($images as $image)
                    <div class="w-full sm:w-[calc(50%-8px)] md:w-[calc(33.333%-11px)] aspect-square overflow-hidden rounded-sm group">
                        <x-responsive-image :src="$image->path" :alt="$image->caption ?? 'Galerie GRIDD'"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                    </div>
                @endforeach
            </div>
            {{ $images->links() }}
        @endif
    </div>
</section>

@endsection
