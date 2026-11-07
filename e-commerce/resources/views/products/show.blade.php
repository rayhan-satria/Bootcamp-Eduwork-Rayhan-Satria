    
@extends('layouts.store')

@section('title', $product->name . ' | Coffea')

@section('content')

<section class="py-5" style="background: var(--coffee-light);">
    <div class="container">

        <div class="mb-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none text-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Products
            </a>
        </div>

        <div class="row g-5 align-items-center">

            {{-- Product Image --}}
            <div class="col-md-6">

                @if ($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid rounded-4 w-100"
                        style="max-height: 500px; object-fit: cover;"
                    >
                @else
                    <div class="rounded-4 bg-body-secondary d-flex justify-content-center align-items-center"
                         style="height: 400px;">
                        <i class="bi bi-image fs-1 text-secondary"></i>
                    </div>
                @endif

            </div>

            {{-- Product Information --}}
            <div class="col-md-6">

                <span class="text-uppercase small fw-semibold"
                      style="color: var(--coffee-brown);">
                    {{ $product->category->name }}
                </span>

                <h1 class="display-5 fw-bold my-3"
                    style="font-family: 'Playfair Display', serif;">
                    {{ $product->name }}
                </h1>

                <h3 class="fw-bold mb-4" style="color: var(--coffee-brown);">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h3>

                <p class="text-secondary mb-4">
                    {{ $product->description ?? 'Belum ada deskripsi produk.' }}
                </p>

                <div class="mb-4">
                    @if ($product->stock > 0)
                        <span class="badge text-bg-success">
                            Available : {{ $product->stock }}
                        </span>
                    @else
                        <span class="badge text-bg-danger">
                            Out of stock
                        </span>
                    @endif
                </div>

                {{-- Add to Cart --}}
                @if ($product->stock > 0)

                    @auth
                        <form action="{{ route('cart.store', $product->id) }}"
                              method="POST"
                              class="d-flex gap-3 align-items-center">

                            @csrf

                            <input
                                type="number"
                                name="quantity"
                                class="form-control"
                                value="1"
                                min="1"
                                max="{{ $product->stock }}"
                                style="max-width: 100px;"
                            >

                            <button type="submit" class="btn flex-grow-1" style="background-color: #a77464;">
                                <i class="bi bi-cart-plus me-2"></i>
                                Order
                            </button>

                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn w-100" style="background-color: #A77464;">
                            Login to order
                        </a>
                    @endauth

                @else

                    <button class="btn btn-secondary w-100" disabled>
                        Out of stock    
                    </button>

                @endif

            </div>

        </div>
    </div>
</section>

@endsection
