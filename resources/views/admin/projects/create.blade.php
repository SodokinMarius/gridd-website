@extends('layouts.admin')

@section('title', 'Nouveau projet')

@section('content')

<form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @include('admin.projects._form', ['project' => null])
    <button type="submit" class="btn-primary">Créer le projet</button>
</form>

@endsection
