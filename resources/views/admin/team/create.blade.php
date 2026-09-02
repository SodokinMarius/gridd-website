@extends('layouts.admin')

@section('title', 'Nouveau membre')

@section('content')

<form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf
    @include('admin.team._form')
    <button type="submit" class="btn-primary">Ajouter</button>
</form>

@endsection
