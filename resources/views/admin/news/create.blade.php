@extends('layouts.admin')

@section('title', 'Nouvelle actualité')

@section('content')

<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @include('admin.news._form', ['news' => null])
    <button type="submit" class="btn-primary">Publier l'actualité</button>
</form>

@endsection
