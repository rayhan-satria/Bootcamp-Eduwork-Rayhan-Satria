
@extends('layouts.store')

@section('title', 'Cart | E-Commerce')

@section('content')

<section class="py-5" style="min-height: 70vh;">
    <div class="container">

        <div class="mb-5">
            <span class="text-uppercase small fw-semibold" style="color: var(--coffee-brown);">
                Your Selection
            </span>
            <h1 class="display-5 fw-bold mt-2"
                style="font-family: 'Playfair Display', serif;">
                Cart Items
            </h1>
        </div>

        {{-- Notification
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif --}}

        @if ($cartItems->isEmpty())

            <div class="text-center bg-white rounded-4 p-5 shadow-sm">
                <i class="bi bi-cart-x display-1 text-secondary"></i>
                <h3 class="mt-3">Your cart is empty</h3>
                <p class="text-secondary">
                    You haven't ordered anything yet.
                </p>
                <a href="{{ route('products.index') }}" class="btn mt-2" style="background-color: #A77464">
                    Order up
                </a>
            </div>

        @else

            <div class="row g-4">

                {{-- Cart Items --}}
                <div class="col-lg-8">

                    <div class="bg-white rounded-4 shadow-sm p-3 p-md-4">

                        @foreach ($cartItems as $item)

                            <div class="row align-items-center g-3 py-3">

                                {{-- Product Image --}}
                                <div class="col-3 col-md-2">
                                    @if ($item->product->image)
                                        <img
                                            src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="img-fluid rounded-3"
                                            style="width: 100%; height: 90px; object-fit: cover;"
                                        >
                                    @else
                                        <div class="bg-body-secondary rounded-3 d-flex justify-content-center align-items-center"
                                             style="height: 90px;">
                                            <i class="bi bi-image fs-3 text-secondary"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Product Name and Price --}}
                                <div class="col-9 col-md-4">
                                    <h6 class="fw-bold mb-1">
                                        {{ $item->product->name }}
                                    </h6>

                                    <small class="text-secondary">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </small>
                                </div>

                                {{-- Quantity --}}
                                <div class="col-6 col-md-3">
                                    <form
                                        action="{{ route('cart.update', $item->id) }}"
                                        method="POST"
                                        class="d-flex gap-2"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            max="{{ $item->product->stock }}"
                                            class="form-control form-control-sm"
                                            style="max-width: 75px;"
                                        >

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-dark"
                                                title="Perbarui jumlah">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                    </form>
                                </div>

                                {{-- Subtotal and Delete --}}
                                <div class="col-6 col-md-3 text-end">
                                    <div class="fw-bold mb-2">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </div>

                                    <form
                                        action="{{ route('cart.destroy', $item->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                            Cancel
                                        </button>
                                    </form>
                                </div>

                            </div>

                            @if (!$loop->last)
                                <hr>
                            @endif

                        @endforeach

                    </div>

                    <div class="mt-3">
                        <a href="{{ route('products.index') }}"
                           class="text-decoration-none text-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Order more
                        </a>
                    </div>

                </div>

                {{-- Order Summary --}}
                <div class="col-lg-4">

                    <div class="bg-white rounded-4 shadow-sm p-4">

                        <h5 class="fw-bold mb-4">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Total Item</span>
                            <span>{{ $cartItems->sum('quantity') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Subtotal</span>
                            <span>
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold fs-5" style="color: var(--coffee-brown);">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="btn w-100" style="background-color: #a77464">
                            Proceed to payment
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                    </div>

                </div>

            </div>

        @endif

    </div>
</section>

@endsection
