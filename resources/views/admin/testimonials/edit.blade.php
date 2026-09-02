@extends('layouts.admin')

@section('title', 'Modifier témoignage')

@section('content')

<form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="bg-white border border-stone-200 rounded-sm p-6 max-w-3xl">
    @csrf @method('PUT')
    @include('admin.testimonials._form', ['testimonial' => $testimonial])
    <button type="submit" class="btn-primary">Enregistrer</button>
</form>

@endsection
