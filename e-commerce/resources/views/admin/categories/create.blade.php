@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1 class="mb-4">Tambah Kategori</h1>

    <form
        action="{{ route('admin.categories.store') }}"
        method="POST"
    >
        @csrf

        @include('admin.categories.form')

        <button type="submit" class="btn btn-primary">
            Simpan Kategori
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </form>

</div>
@endsection