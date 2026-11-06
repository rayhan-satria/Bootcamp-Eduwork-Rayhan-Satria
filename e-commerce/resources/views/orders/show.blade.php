
@extends('layouts.store')

@section('title', 'Order Detail | Coffea')

@section('content')

<section class="py-5" style="background: var(--coffee-light); min-height: 70vh;">
    <div class="container">

        <div class="mb-4">
            <a href="{{ route('orders.index') }}"
               class="text-decoration-none text-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                To order history
            </a>
        </div>

        {{-- Order Header --}}
        <div class="bg-white rounded-4 shadow-sm p-4 mb-4">

            <div class="row align-items-center g-3">

                <div class="col-md-8">
                    <small class="text-secondary">
                        Order nummber
                    </small>

                    <h4 class="fw-bold mt-1">
                        {{ $order->order_number }}
                    </h4>

                    <small class="text-secondary">
                        Created on {{ $order->created_at->format('d M Y, H:i') }}
                    </small>
                </div>

                <div class="col-md-4 text-md-end">

                    @php
                        $statusClass = match ($order->status) {
                            'pending' => 'text-bg-warning',
                            'processing' => 'text-bg-info',
                            'completed' => 'text-bg-success',
                            'cancelled' => 'text-bg-danger',
                            default => 'text-bg-secondary',
                        };
                    @endphp

                    <span class="badge {{ $statusClass }} fs-6">
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

            </div>

        </div>

        <div class="row g-4">

            {{-- Order Items --}}
            <div class="col-lg-8">

                <div class="bg-white rounded-4 shadow-sm p-4">

                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-bag me-2"></i>
                        Order Items
                    </h5>

                    @foreach ($order->orderItems as $item)

                        <div class="d-flex justify-content-between align-items-start gap-3 py-3">

                            <div>
                                <h6 class="fw-semibold mb-1">
                                    {{ $item->product_name }}
                                </h6>

                                <small class="text-secondary">
                                    {{ $item->quantity }} ×
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </small>
                            </div>

                            <div class="fw-bold text-nowrap">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>

                        </div>

                        @if (!$loop->last)
                            <hr>
                        @endif

                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total</span>

                        <span class="fw-bold fs-5"
                              style="color: var(--coffee-brown);">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

            </div>

            {{-- Shipping Information --}}
            <div class="col-lg-4">

                <div class="bg-white rounded-4 shadow-sm p-4">

                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-geo-alt me-2"></i>
                        Order Information
                    </h5>

                    <small class="text-secondary">
                        Ordered by
                    </small>

                    <p class="fw-semibold mb-3">
                        {{ $order->user->name }}
                    </p>

                    <small class="text-secondary">
                        Table number
                    </small>

                    <p class="mb-0">
                        {{ $order->shipping_address }}
                    </p>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
