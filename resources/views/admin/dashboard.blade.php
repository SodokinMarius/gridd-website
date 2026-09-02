@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')

<div class="flex flex-wrap gap-6 mb-10">
    <div class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-white border border-stone-200 rounded-sm p-6">
        <p class="text-sm text-stone-600 mb-2">Réalisations</p>
        <p class="text-3xl font-display font-semibold">{{ $stats['projects'] }}</p>
    </div>
    <div class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-white border border-stone-200 rounded-sm p-6">
        <p class="text-sm text-stone-600 mb-2">Actualités publiées</p>
        <p class="text-3xl font-display font-semibold">{{ $stats['news_published'] }}</p>
    </div>
    <div class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-white border border-stone-200 rounded-sm p-6">
        <p class="text-sm text-stone-600 mb-2">Offres d'emploi actives</p>
        <p class="text-3xl font-display font-semibold">{{ $stats['jobs_active'] }}</p>
    </div>
    <div class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-white border border-stone-200 rounded-sm p-6">
        <p class="text-sm text-stone-600 mb-2">Actualités (total)</p>
        <p class="text-3xl font-display font-semibold">{{ $stats['news'] }}</p>
    </div>
</div>

<div class="flex flex-wrap gap-6">
    <div class="w-full lg:w-[calc(50%-12px)] bg-white border border-stone-200 rounded-sm p-6">
        <h2 class="font-display font-medium mb-4">Dernières actualités</h2>
        <ul class="divide-y divide-stone-100">
            @forelse ($latestNews as $item)
                <li class="py-2 text-sm flex justify-between">
                    <span>{{ $item->title }}</span>
                    <span class="text-stone-500">{{ $item->is_published ? 'Publiée' : 'Brouillon' }}</span>
                </li>
            @empty
                <li class="py-2 text-sm text-stone-500">Aucune actualité.</li>
            @endforelse
        </ul>
    </div>
    <div class="w-full lg:w-[calc(50%-12px)] bg-white border border-stone-200 rounded-sm p-6">
        <h2 class="font-display font-medium mb-4">Derniers projets</h2>
        <ul class="divide-y divide-stone-100">
            @forelse ($latestProjects as $item)
                <li class="py-2 text-sm flex justify-between">
                    <span>{{ $item->title }}</span>
                    <span class="text-stone-500">{{ $item->country }}</span>
                </li>
            @empty
                <li class="py-2 text-sm text-stone-500">Aucun projet.</li>
            @endforelse
        </ul>
    </div>
</div>

@endsection
