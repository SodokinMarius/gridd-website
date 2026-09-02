@extends('layouts.admin')

@section('title', 'Nouvelle offre d\'emploi')

@section('content')

<form method="POST" action="{{ route('admin.jobs.store') }}" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @include('admin.jobs._form', ['job' => null])
    <button type="submit" class="btn-primary">Publier l'offre</button>
</form>

@endsection
