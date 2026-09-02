@extends('layouts.admin')

@section('title', 'Nouvelle slide')

@section('content')

<form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @include('admin.hero._form')
    <button type="submit" class="btn-primary">Ajouter au carrousel</button>
</form>

@endsection
