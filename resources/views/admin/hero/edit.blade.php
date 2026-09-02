@extends('layouts.admin')

@section('title', 'Modifier slide')

@section('content')

<form method="POST" action="{{ route('admin.hero.update', $slide) }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf @method('PUT')
    @include('admin.hero._form', ['slide' => $slide])
    <button type="submit" class="btn-primary">Enregistrer</button>
</form>

@endsection
