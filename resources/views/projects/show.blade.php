@extends('layouts.app')

@section('title', $project->title.' — GRIDD Consulting et Services')

@section('content')

<section class="py-16 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">{{ $project->country }} @if($project->year) — {{ $project->year }} @endif</p>
        <h1 class="text-3xl md:text-4xl font-semibold mb-4">{{ $project->title }}</h1>
        @if ($project->client)
            <p class="text-ink/60">Client / partenaire : {{ $project->client }}</p>
        @endif
    </div>
</section>

@if ($project->images->isNotEmpty())
<section class="py-12">
    <div class="container-content flex flex-wrap gap-4">
        @foreach ($project->images as $image)
            <div class="w-full md:w-[calc(50%-8px)] aspect-[4/3] overflow-hidden rounded-sm">
                <x-responsive-image :src="$image->path" :alt="$project->title" class="w-full h-full object-cover" />
            </div>
        @endforeach
    </div>
</section>
@endif

<section class="py-12 border-t border-stone-200">
    <div class="container-content max-w-3xl">
        <h2 class="text-xl font-semibold mb-4">Description du projet</h2>
        <p class="text-ink/70 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
    </div>
</section>

<section class="py-12">
    <div class="container-content">
        <a href="{{ route('projects.index') }}" class="nav-link">← Retour aux réalisations</a>
    </div>
</section>

@endsection
