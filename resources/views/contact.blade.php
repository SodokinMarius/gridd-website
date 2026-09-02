@extends('layouts.app')

@section('title', 'Contact — GRIDD Consulting et Services')

@section('content')

<section class="py-20 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Contact</p>
        <h1 class="text-4xl md:text-5xl font-semibold">Parlons de votre projet.</h1>
    </div>
</section>

<section class="py-16">
    <div class="container-content flex flex-wrap gap-12">
        <div class="w-full md:w-[calc(40%-24px)]">
            <h2 class="text-xl font-semibold mb-6">Nos coordonnées</h2>
            <ul class="space-y-4 text-ink/70">
                <li><strong class="text-ink block">Adresse</strong>Cotonou, Bénin</li>
                <li><strong class="text-ink block">Téléphone</strong>+229 00 00 00 00</li>
                <li><strong class="text-ink block">Email</strong>contact@gridd-cs.com</li>
            </ul>
        </div>

        <div class="w-full md:w-[calc(60%-24px)]">
            @if ($errors->any())
                <div class="bg-clay-50 border border-clay-300 text-clay-600 text-sm px-4 py-3 rounded-sm mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf
                <div class="flex flex-wrap gap-5">
                    <div class="w-full md:w-[calc(50%-10px)]">
                        <label class="block text-sm mb-2" for="name">Nom complet</label>
                        <input id="name" name="name" value="{{ old('name') }}" required
                               class="w-full border border-stone-200 rounded-sm px-4 py-3 bg-white focus:border-ink outline-none">
                    </div>
                    <div class="w-full md:w-[calc(50%-10px)]">
                        <label class="block text-sm mb-2" for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="w-full border border-stone-200 rounded-sm px-4 py-3 bg-white focus:border-ink outline-none">
                    </div>
                </div>
                <div class="flex flex-wrap gap-5">
                    <div class="w-full md:w-[calc(50%-10px)]">
                        <label class="block text-sm mb-2" for="phone">Téléphone (optionnel)</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}"
                               class="w-full border border-stone-200 rounded-sm px-4 py-3 bg-white focus:border-ink outline-none">
                    </div>
                    <div class="w-full md:w-[calc(50%-10px)]">
                        <label class="block text-sm mb-2" for="subject">Sujet</label>
                        <input id="subject" name="subject" value="{{ old('subject') }}" required
                               class="w-full border border-stone-200 rounded-sm px-4 py-3 bg-white focus:border-ink outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm mb-2" for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required
                              class="w-full border border-stone-200 rounded-sm px-4 py-3 bg-white focus:border-ink outline-none">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-primary">Envoyer le message</button>
            </form>
        </div>
    </div>
</section>

@endsection
