@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1 class="mb-4">Edit Kategori</h1>

    <form
        action="{{ route('admin.categories.update', $productCategory->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        @include('admin.categories.form')

        <button type="submit" class="btn btn-primary">
            Update Kategori
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </form>

</div>
@endsection