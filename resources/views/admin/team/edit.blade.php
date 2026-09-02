@extends('layouts.admin')

@section('title', 'Modifier membre')

@section('content')

<form method="POST" action="{{ route('admin.team.update', $member) }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf @method('PUT')
    @include('admin.team._form', ['member' => $member])
    <button type="submit" class="btn-primary">Enregistrer</button>
</form>

@endsection
