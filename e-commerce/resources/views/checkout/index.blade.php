
@extends('layouts.store')

@section('title', 'Checkout | Coffea')

@section('content')

<section class="py-5" style="background: var(--coffee-light); min-height: 70vh;">
    <div class="container">

        <div class="mb-5">
            <span class="text-uppercase small fw-semibold"
                  style="color: var(--coffee-brown);">
                Almost There
            </span>

            <h1 class="display-5 fw-bold mt-2"
                style="font-family: 'Playfair Display', serif;">
                Checkout
            </h1>

            <p class="text-secondary">
                Double check your table & cravings.
            </p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="row g-4">

                {{-- Shipping Information --}}
                <div class="col-lg-7">

                    <div class="bg-white rounded-4 shadow-sm p-4">

                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-geo-alt me-2"></i>
                            Order Information
                        </h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Name for the order
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ auth()->user()->name }}"
                                disabled
                            >

                            <small class="text-secondary">
                                Autofilled from your profile
                            </small>
                            
                        </div>

                        <div class="mb-3">
                            <label for="table-number"
                                   class="form-label fw-semibold">
                                Table number
                            </label>

                            <textarea
                                name="shipping_address"
                                id="shipping_address"
                                rows="5"
                                class="form-control @error('shipping_address') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap, termasuk jalan, nomor rumah, kelurahan, kecamatan, kota, dan kode pos."
                                required
                            >{{ old('shipping_address') }}</textarea>

                            @error('shipping_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="alert alert-light border mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Pastikan alamat sudah benar sebelum mengonfirmasi pesanan.
                        </div>

                    </div>

                </div>

                {{-- Order Summary --}}
                <div class="col-lg-5">

                    <div class="bg-white rounded-4 shadow-sm p-4">

                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-receipt me-2"></i>
                            Order Summary
                        </h5>

                        @foreach ($cartItems as $item)

                            <div class="d-flex justify-content-between gap-3 mb-3">

                                <div>
                                    <div class="fw-semibold">
                                        {{ $item->product->name }}
                                    </div>

                                    <small class="text-secondary">
                                        {{ $item->quantity }} ×
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    </small>
                                </div>

                                <div class="fw-semibold text-nowrap">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>

                            </div>

                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Total Item</span>
                            <span>{{ $cartItems->sum('quantity') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total Pembayaran</span>

                            <span class="fw-bold fs-5"
                                  style="color: var(--coffee-brown);">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="submit" class="btn btn-coffee w-100">
                            Konfirmasi Pesanan
                            <i class="bi bi-check-circle ms-2"></i>
                        </button>

                        <a href="{{ route('cart.index') }}"
                           class="btn btn-outline-secondary w-100 mt-2">
                            Kembali ke Keranjang
                        </a>

                        <p class="text-secondary small text-center mt-3 mb-0">
                            Dengan mengonfirmasi, kamu menyetujui detail pesanan di atas.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>
</section>

@endsection
