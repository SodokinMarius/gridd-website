@extends('layouts.app')

@section('title', 'Nos services — GRIDD Consulting et Services')

@section('content')

<section class="py-20 border-b border-stone-200 bg-white">
    <div class="container-content max-w-3xl">
        <p class="eyebrow mb-3">Nos services</p>
        <h1 class="text-4xl md:text-5xl font-semibold">Deux pôles d'expertise, une même exigence de rigueur.</h1>
    </div>
</section>

<section class="py-20">
    <div class="container-content space-y-16">
        @foreach ($poles as $pole)
            <div class="pole-panel {{ $pole['theme'] === 'green' ? 'pole-green' : 'pole-clay' }}">
                <h2 class="text-2xl md:text-3xl font-semibold mb-6">{{ $pole['pole'] }}</h2>
                <ul class="grid md:grid-cols-2 gap-x-8 gap-y-2 text-paper/85 text-sm leading-relaxed">
                    @foreach ($pole['items'] as $item)
                        <li>— {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>

<section class="py-20 bg-white border-t border-stone-200">
    <div class="container-content max-w-3xl">
        <h2 class="text-2xl font-semibold mb-4">Moyens matériels et logistiques</h2>
        <p class="text-ink/70 leading-relaxed mb-4">
            GRIDD Consulting et Services dispose d'un parc automobile et informatique étoffé, ainsi que
            d'un matériel technique de pointe (station totale, théodolite, GPS, analyseurs de gaz de combustion,
            sonomètre, luxmètre, détecteurs de poussière et de gaz...) permettant de fournir des prestations
            de qualité dans les meilleurs délais.
        </p>
    </div>
</section>

@endsection
