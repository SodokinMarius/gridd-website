@extends('layouts.app')

@section('title', 'Postuler — '.$job->title)

@section('content')

<section class="page-hero">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Candidature spontanée</p>
        <h1 class="page-title">{{ $job->title }}</h1>
        <p class="page-lead mt-4">Remplissez le formulaire ci-dessous pour envoyer votre candidature et votre CV.</p>
    </div>
</section>

<section class="section-block">
    <div class="container-content max-w-2xl">
        @if ($errors->any())
            <div class="alert-error mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('jobs.apply.store', $job) }}" enctype="multipart/form-data" class="form-stack">
            @csrf
            <div class="form-row">
                <div class="form-field">
                    <label for="first_name">Prénom</label>
                    <input id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>
                <div class="form-field">
                    <label for="last_name">Nom</label>
                    <input id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-field">
                    <label for="phone">Téléphone</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>
            </div>
            <div class="form-field">
                <label for="cover_letter">Lettre de motivation (optionnel)</label>
                <textarea id="cover_letter" name="cover_letter" rows="6">{{ old('cover_letter') }}</textarea>
            </div>
            <div class="form-field">
                <label for="cv">CV (PDF, DOC ou DOCX — max 5 Mo)</label>
                <input id="cv" type="file" name="cv" accept=".pdf,.doc,.docx" required>
            </div>
            <div class="flex flex-wrap gap-4 items-center">
                <button type="submit" class="btn-primary">Envoyer ma candidature</button>
                <a href="{{ route('jobs.show', $job) }}" class="nav-link">← Retour à l'offre</a>
            </div>
        </form>
    </div>
</section>

@endsection
