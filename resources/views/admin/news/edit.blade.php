@extends('layouts.admin')

@section('title', "Modifier l'actualité")

@section('content')

<form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @method('PUT')
    @include('admin.news._form', ['news' => $news])
    <button type="submit" class="btn-primary">Enregistrer les modifications</button>
</form>

@endsection
