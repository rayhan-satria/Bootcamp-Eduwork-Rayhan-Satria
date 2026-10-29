@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <h1>Katalog Produk Kami</h1>
    <p>Ini adalah daftar produk yang tersedia:</p>
    
    <!-- Contoh Mockup List Produk -->
    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background: #fff;">
            <h3>Sepatu Keren</h3>
            <p>Harga: Rp 250.000</p>
            <button>Tambah ke Keranjang</button>
        </div>
        <div style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background: #fff;">
            <h3>Baju Kece</h3>
            <p>Harga: Rp 120.000</p>
            <button>Tambah ke Keranjang</button>
        </div>
    </div>
@endsection
