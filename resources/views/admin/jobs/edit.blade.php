@extends('layouts.admin')

@section('title', "Modifier l'offre d'emploi")

@section('content')

<form method="POST" action="{{ route('admin.jobs.update', $job) }}" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @method('PUT')
    @include('admin.jobs._form', ['job' => $job])
    <button type="submit" class="btn-primary">Enregistrer les modifications</button>
</form>

@endsection
