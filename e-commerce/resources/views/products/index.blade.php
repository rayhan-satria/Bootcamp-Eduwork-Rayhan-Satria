
@extends('layouts.store')

@section('title', 'Products | Coffea')

@section('content')

<section class="py-5" style="background-color: #BEB1B8">
    <div class="container">

        <div class="mb-5">
            <span class="text-uppercase small fw-semibold" style="color: var(--coffee-brown);">
                Our Collection
            </span>
            <h1 class="display-5 fw-bold mt-2" style="font-family: 'Playfair Display', serif;">
                Explore Our Menu
            </h1>
            <p class="text-secondary">
                Find your favorite brew and the perfect bites to match your day.
            </p>
        </div>

        {{-- Search and Filter --}}
        <form action="{{ route('products.index') }}" method="GET" class="row g-3 mb-5">

            <div class="col-md-6">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="What are you craving today?"
                    value="{{ request('search') }}"
                >
            </div>

            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">View All</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->slug }}"
                            {{ request('category') == $category->slug ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button type="submit" class="btn" style="background-color: #a77464;">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>

        </form>

        {{-- Product List --}}
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

        {{-- Pagination --}}
        <div class="mt-5">
            {{ $products->links() }}
        </div>

    </div>
</section>

@endsection
