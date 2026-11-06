@extends('layouts.store')

@section('content')
    <div class="container py-5">

        <h1>{{ $productCategory->name }}</h1>

        <p>{{ $productCategory->description }}</p>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">

                        @if ($product->image)
                            <img
                                src="{{ asset($product->image) }}"
                                class="card-img-top"
                                alt="{{ $product->name }}"
                            >
                        @endif

                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>

                            <p>
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <a
                                href="{{ route('products.show', $product->slug) }}"
                                class="btn btn-primary"
                            >
                                Detail
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <p>Belum ada produk dalam kategori ini.</p>
            @endforelse
        </div>

        {{ $products->links() }}

    </div>
@endsection