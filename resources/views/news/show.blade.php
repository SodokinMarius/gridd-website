@extends('layouts.app')

@section('title', $news->title.' — GRIDD Consulting et Services')

@section('content')
<section class="page-hero">
    <div class="container-content max-w-4xl">
        <p class="eyebrow mb-3">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
        <h1 class="page-title">{{ $news->title }}</h1>
    </div>
</section>

@if ($news->cover_image)
<section class="section-block pb-8">
    <div class="container-content">
        <div class="news-article-cover">
            <x-responsive-image :src="$news->cover_image" :alt="$news->title" class="h-full w-full object-cover" />
        </div>
    </div>
</section>
@endif

<section class="section-block pt-8">
    <div class="container-content">
        <div class="news-article-layout">
            <article class="prose-content max-w-3xl">
                {!! nl2br(e($news->content)) !!}
            </article>

            @if ($news->images->isNotEmpty())
                <aside class="news-gallery" aria-label="Galerie de l’actualité">
                    <div class="mb-6">
                        <p class="eyebrow mb-3">En images</p>
                        <h2 class="font-display text-2xl font-bold tracking-[-0.04em]">Retour en images</h2>
                    </div>
                    <div class="news-gallery-grid">
                        @foreach ($news->images as $image)
                            <figure class="news-gallery-item">
                                <x-responsive-image :src="$image->path" :alt="$image->caption ?: 'Image de '.$news->title" class="h-full w-full object-cover" />
                                @if ($image->caption)
                                    <figcaption>{{ $image->caption }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                </aside>
            @endif
        </div>
    </div>
</section>

@if ($related->isNotEmpty())
<section class="section-block section-alt">
    <div class="container-content">
        <h2 class="section-title mb-8">Autres actualités</h2>
        <div class="cards-grid-3">
            @foreach ($related as $article)
                <a href="{{ route('news.show', $article) }}" class="news-card">
                    <div class="news-card-body">
                        <p class="mb-2 text-xs font-medium text-clay-600">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                        <p class="font-display text-lg font-semibold text-ink">{{ $article->title }}</p>
                        <span class="nav-link mt-4 self-start">Lire l’article →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
