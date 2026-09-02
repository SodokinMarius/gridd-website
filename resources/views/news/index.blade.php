@extends('layouts.app')

@section('title', 'Actualités — GRIDD Consulting et Services')

@section('content')

<section class="py-20 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Actualités</p>
        <h1 class="text-4xl md:text-5xl font-semibold">La vie de GRIDD, au fil des missions.</h1>
    </div>
</section>

<section class="py-16">
    <div class="container-content">
        @if ($news->isEmpty())
            <p class="text-ink/60">Aucune actualité publiée pour le moment.</p>
        @else
            <div class="flex flex-wrap gap-6 mb-12">
                @foreach ($news as $article)
                    <a href="{{ route('news.show', $article) }}" class="w-full md:w-[calc(33.333%-16px)] bg-white border border-stone-200 rounded-sm p-6 block hover:border-ink transition-colors">
                        @if ($article->cover_image)
                            <div class="aspect-[16/9] mb-4 overflow-hidden rounded-sm">
                                <x-responsive-image :src="$article->cover_image" :alt="$article->title" class="w-full h-full object-cover" />
                            </div>
                        @endif
                        <p class="text-xs text-clay-500 mb-2">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                        <h2 class="font-display font-medium text-lg mb-2">{{ $article->title }}</h2>
                        <p class="text-sm text-ink/60 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                    </a>
                @endforeach
            </div>
            {{ $news->links() }}
        @endif
    </div>
</section>

@endsection
