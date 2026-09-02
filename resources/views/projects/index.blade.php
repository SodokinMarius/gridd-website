@extends('layouts.app')

@section('title', 'Nos réalisations — GRIDD Consulting et Services')

@section('content')

<section class="py-20 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Réalisations</p>
        <h1 class="text-4xl md:text-5xl font-semibold">Des projets qui ancrent nos convictions dans le terrain.</h1>
    </div>
</section>

<section class="py-16">
    <div class="container-content">
        <div class="flex flex-wrap gap-3 mb-12">
            <a href="{{ route('projects.index') }}"
               class="px-4 py-2 rounded-sm text-sm border {{ !$country ? 'bg-ink text-paper border-ink' : 'border-stone-200 text-ink/70 hover:border-ink' }} transition-colors">
                Tous les pays
            </a>
            @foreach ($countries as $c)
                <a href="{{ route('projects.index', ['pays' => $c]) }}"
                   class="px-4 py-2 rounded-sm text-sm border {{ $country === $c ? 'bg-ink text-paper border-ink' : 'border-stone-200 text-ink/70 hover:border-ink' }} transition-colors">
                    {{ $c }}
                </a>
            @endforeach
        </div>

        @if ($projects->isEmpty())
            <p class="text-ink/60">Aucune réalisation publiée pour le moment.</p>
        @else
            <div class="flex flex-wrap gap-6 mb-12">
                @foreach ($projects as $project)
                    <div class="w-full md:w-[calc(33.333%-16px)]">
                        <x-project-card :project="$project" />
                    </div>
                @endforeach
            </div>
            {{ $projects->links() }}
        @endif
    </div>
</section>

@endsection
