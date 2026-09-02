@extends('layouts.app')

@section('title', $news->title.' — GRIDD Consulting et Services')

@section('content')

<section class="py-16 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
        <h1 class="text-3xl md:text-4xl font-semibold">{{ $news->title }}</h1>
    </div>
</section>

@if ($news->cover_image)
<section class="py-12">
    <div class="container-content">
        <div class="aspect-[16/9] rounded-sm overflow-hidden">
            <x-responsive-image :src="$news->cover_image" :alt="$news->title" class="w-full h-full object-cover" />
        </div>
    </div>
</section>
@endif

<section class="py-12">
    <div class="container-content max-w-3xl prose prose-neutral">
        {!! nl2br(e($news->content)) !!}
    </div>
</section>

@if ($related->isNotEmpty())
<section class="py-16 bg-white border-t border-stone-200">
    <div class="container-content">
        <h2 class="text-xl font-semibold mb-8">Autres actualités</h2>
        <div class="flex flex-wrap gap-6">
            @foreach ($related as $article)
                <a href="{{ route('news.show', $article) }}" class="w-full md:w-[calc(33.333%-16px)] block hover:opacity-80 transition-opacity">
                    <p class="text-xs text-clay-500 mb-2">{{ $article->published_at?->translatedFormat('d F Y') }}</p>
                    <p class="font-display font-medium">{{ $article->title }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
