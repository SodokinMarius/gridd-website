@extends('layouts.app')

@section('title', 'Contact - GRIDD Consulting et Services')

@section('content')

<section class="page-hero">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Contact</p>
        <h1 class="page-title">Parlons de votre projet.</h1>
    </div>
</section>

<section class="section-block">
    <div class="container-content grid gap-12 md:grid-cols-5">
        <div class="md:col-span-2">
            <div class="info-card">
                <h2 class="info-card-title text-xl">Nos coordonnées</h2>
                <ul class="info-card-text space-y-4">
                    <li><strong class="text-ink block">Adresse</strong>Abomey-Calavi, Bénin</li>
                    <li><strong class="text-ink block">Téléphone</strong>+229 01 96 42 53 83</li>
                    <li><strong class="text-ink block">Email</strong>contact@gridd-cs.com</li>
                </ul>
            </div>
        </div>

        <div class="md:col-span-3">
            @if ($errors->any())
                <div class="alert-error mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="form-stack">
                @csrf
                <div class="form-row">
                    <div class="form-field">
                        <label for="name">Nom complet</label>
                        <input id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label for="phone">Téléphone (optionnel)</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                    <div class="form-field">
                        <label for="subject">Sujet</label>
                        <input id="subject" name="subject" value="{{ old('subject') }}" required>
                    </div>
                </div>
                <div class="form-field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-primary">Envoyer le message</button>
            </form>
        </div>
    </div>
</section>

@endsection
