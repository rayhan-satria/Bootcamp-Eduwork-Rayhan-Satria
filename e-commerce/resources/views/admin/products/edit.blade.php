@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1 class="mb-4">Edit Produk</h1>

    <form
        action="{{ route('admin.products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.products.form')

        <button type="submit" class="btn btn-primary">
            Update Produk
        </button>

        <a href="{{ route('admin.products.index') }}"
           class="btn btn-secondary">
            Batal
        </a>
    </form>

</div>
@endsection