@extends('layouts.store')

@section('content')
    <div class="container mb-3">

        <h1>{{ $productCategory->name }}</h1>

        <p>{{ $productCategory->description }}</p>

        <form action="{{ route('categories.show', $productCategory->slug) }}" method="GET" class="row g-3 mb-3">

            <div class="col-md-6">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="What are you looking for?"
                    value="{{ request('search') }}"
                >
            </div>
            
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn" style="background-color: #a77464;">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
        </form>

        <div class="row g-4">

            @forelse ($products as $product)

                <div class="col-6 col-md-4 col-lg-3">
                    <x-store.product-card :product="$product" />
                </div>

            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search fs-1 text-secondary"></i>
                    <h4 class="mt-3">Produk tidak ditemukan</h4>
                    <p class="text-secondary">
                        Coba gunakan kata kunci atau kategori lain.
                    </p>

                    <a href="{{ route('products.index') }}" class="btn btn-coffee">
                        Lihat Semua Produk
                    </a>
                </div>
            @endforelse
        </div>

        {{ $products->links() }}

    </div>
@endsection