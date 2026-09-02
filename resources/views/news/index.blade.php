@extends('layouts.app')

@section('title', 'Actualités — GRIDD Consulting et Services')

@section('content')
<section class="page-hero">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Actualités</p>
        <h1 class="page-title">La vie de GRIDD, au fil des missions.</h1>
    </div>
</section>

<section class="section-block">
    <div class="container-content">
        @if ($news->isEmpty())
            <p class="text-ink/60">Aucune actualité publiée pour le moment.</p>
        @else
            <div class="cards-grid-3 mb-12">
                @foreach ($news as $article)
                    @php $previewImage = $article->cover_image ?: $article->images->first()?->path; @endphp
                    <a href="{{ route('news.show', $article) }}" class="news-card group">
                        @if ($previewImage)
                            <div class="news-card-image">
                                <x-responsive-image :src="$previewImage" :alt="$article->title" class="w-full h-full object-cover" />
                            </div>
                        @endif
                        <div class="news-card-body">
                            <p class="mb-2 text-xs font-medium text-clay-600">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                            <h2 class="mb-3 font-display text-lg font-medium text-ink">{{ $article->title }}</h2>
                            <p class="mb-5 line-clamp-3 text-sm leading-6 text-ink/60">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 140) }}</p>
                            <span class="nav-link mt-auto self-start">Lire l’article →</span>
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $news->links() }}
        @endif
    </div>
</section>
@endsection
