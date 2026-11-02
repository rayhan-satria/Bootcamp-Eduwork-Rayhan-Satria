@extends('layouts.app')

@section('title', 'Cafe Order')

@section('content')
<div class="container my-5 p-4 bg-white rounded shadow-sm">
    <div class="row">
        <!-- 1. KOLOM DAFTAR MENU DINAMIS (Kiri) -->
        <div class="col-lg-8 mb-4">
            <h2 class="fw-bold mb-4" style="color: #2c3e50; font-family: 'Georgia', serif;">📋 Review your spot.</h2>
            
            <div class="table-responsive">
                <table class="table align-middle" style="border-bottom: 1px solid #dee2e6;">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 45%;">Menu</th>
                            <th scope="col" class="text-center" style="width: 15%;">Price</th>
                            <th scope="col" class="text-center" style="width: 20%;">Quantity</th>
                            <th scope="col" class="text-end" style="width: 20%;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $subtotal = 0; @endphp
                        
                        @if(count($cart) > 0)
                            @foreach($cart as $id => $details)
                            @php 
                                $totalPerMenu = $details['price'] * $details['quantity'];
                                $subtotal += $totalPerMenu;
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 60px; height: 60px; border-radius: 6px; overflow: hidden; background: #eee; margin-right: 15px;">
                                            @if($details['image'])
                                                <img src="{{ Vite::asset('resources/images/' . strtolower($details['category_name']) . '/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #aaa; font-size: 11px;">No Image</div>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ $details['name'] }}</h6>
                                            <small class="text-muted">Category: {{ $details['category_name'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <!-- ➕➖ UI FORM UNTUK UPDATE QUANTITY -->
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <!-- Tombol Kurang (-) -->
                                        <form action="{{ route('cart.update', $id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm px-2 py-0 fw-bold">-</button>
                                        </form>

                                        <span class="fw-bold px-1">{{ $details['quantity'] }}</span>

                                        <!-- Tombol Tambah (+) -->
                                        <form action="{{ route('cart.update', $id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm px-2 py-0 fw-bold">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end align-items-center gap-3">
                                        <span class="fw-bold">Rp {{ number_format($totalPerMenu, 0, ',', '.') }}</span>
                                        
                                        <!-- 🗑️ TOMBOL HAPUS MENU -->
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1 shadow-sm" title="Hapus Menu" onclick="return confirm('Changed your mind?')">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <span style="font-size: 40px;">🛒</span>
                                    <p class="mt-2 mb-0">Empty table alert! What are we having today?</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-outline-dark fw-bold mt-3">
                ⬅️ Add another
            </a>
        </div>

        <!-- 2. KOLOM TOTAL TAGIHAN OTOMATIS BERHITUNG (Kanan) -->
        <div class="col-lg-4">
            <div class="p-4 rounded-3" style="background: #f8f9fa; border: 1px solid #e9ecef;">
                <h4 class="fw-bold mb-3" style="color: #2c3e50;">Amount to pay</h4>
                <hr>
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small">Table number:</label>
                    <select class="form-select fw-bold">
                        <option>05 (Indoor)</option>
                        <option>06 (Indoor)</option>
                    </select>
                </div>

                <!-- Hitungan Matematika Otomatis Mengikuti Isi Keranjang -->
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                @php $pajak = $subtotal * 0.1; $totalAkhir = $subtotal + $pajak; @endphp
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Tax PB1 (10%)</span>
                    <span class="fw-semibold">Rp {{ number_format($pajak, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="fw-bold text-dark">Grand Total:</span>
                    <h3 class="fw-bold text-danger mb-0">Rp {{ number_format($totalAkhir, 0, ',', '.') }}</h3>
                </div>

                <a href="{{ route('checkout') }}" class="btn btn-success w-100 py-3 fw-bold shadow-sm" style="font-size: 16px;">
                    🚀 Place Order
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
