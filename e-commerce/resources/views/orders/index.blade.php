
@extends('layouts.store')

@section('title', 'My Orders | Coffea')

@section('content')

<section class="py-5" style="background: var(--coffee-light); min-height: 70vh;">
    <div class="container">

        <div class="mb-5">
            <span class="text-uppercase small fw-semibold"
                  style="color: var(--coffee-brown);">
                Purchase History
            </span>

            <h1 class="display-5 fw-bold mt-2"
                style="font-family: 'Playfair Display', serif;">
                My Orders
            </h1>

            <p class="text-secondary">
                Review Orders
            </p>
        </div>

        @if ($orders->isEmpty())

            <div class="bg-white rounded-4 shadow-sm text-center p-5">
                <i class="bi bi-receipt display-1 text-secondary"></i>

                <h4 class="mt-3">Your tray is empty</h4>

                <p class="text-secondary">
                    You haven't ordered anything yet.
                </p>

                <a href="{{ route('products.index') }}"
                   class="btn btn-coffee mt-2">
                    Order up.
                </a>
            </div>

        @else

            <div class="d-flex flex-column gap-3">

                @foreach ($orders as $order)

                    <div class="bg-white rounded-4 shadow-sm p-4">

                        <div class="row align-items-center g-3">

                            <div class="col-md-3">
                                <small class="text-secondary d-block">
                                    Nomor Pesanan
                                </small>

                                <span class="fw-bold">
                                    {{ $order->order_number }}
                                </span>
                            </div>

                            <div class="col-md-2">
                                <small class="text-secondary d-block">
                                    Tanggal
                                </small>

                                <span>
                                    {{ $order->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <div class="col-md-3">
                                <small class="text-secondary d-block">
                                    Total Pembayaran
                                </small>

                                <span class="fw-bold">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="col-md-2">
                                <small class="text-secondary d-block">
                                    Status
                                </small>

                                @php
                                    $statusClass = match ($order->status) {
                                        'pending' => 'text-bg-warning',
                                        'processing' => 'text-bg-info',
                                        'completed' => 'text-bg-success',
                                        'cancelled' => 'text-bg-danger',
                                        default => 'text-bg-secondary',
                                    };
                                @endphp

                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div class="col-md-2 text-md-end">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="btn btn-outline-dark btn-sm">
                                    Detail
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        @endif

    </div>
</section>

@endsection
