@extends('layouts.app')

@section('title', 'Postes vacants - GRIDD Consulting et Services')

@section('content')

<section class="page-hero">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Postes vacants</p>
        <h1 class="page-title">Rejoignez une équipe engagée pour le développement durable.</h1>
    </div>
</section>

<section class="section-block">
    <div class="container-content">
        @if ($jobs->isEmpty())
            <p class="text-ink/60">Aucune offre active pour le moment. Revenez bientôt !</p>
        @else
            <div class="space-y-5 mb-12">
                @foreach ($jobs as $job)
                    <a href="{{ route('jobs.show', $job) }}" class="job-card">
                        <div>
                            <h2 class="font-display font-semibold text-lg mb-1">{{ $job->title }}</h2>
                            <p class="text-sm text-ink/60">{{ $job->contract_type }} @if($job->location) - {{ $job->location }} @endif</p>
                        </div>
                        <div class="text-sm text-clay-500">
                            @if($job->deadline)
                                Date limite : {{ $job->deadline->translatedFormat('d F Y') }}
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
            {{ $jobs->links() }}
        @endif
    </div>
</section>

@endsection
