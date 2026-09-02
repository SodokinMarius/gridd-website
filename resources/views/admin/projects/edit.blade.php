@extends('layouts.admin')

@section('title', 'Modifier le projet')

@section('content')

<form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @method('PUT')
    @include('admin.projects._form', ['project' => $project])
    <button type="submit" class="btn-primary">Enregistrer les modifications</button>
</form>

@endsection
