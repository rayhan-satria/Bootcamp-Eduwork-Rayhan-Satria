@extends('layouts.app')

@section('title', 'Keranjang Belanja Lu')

@section('content')
    <h1>Keranjang Belanja Anda</h1>
    <p>Berikut adalah barang-barang yang siap lu checkout:</p>
    <ul>
        <li>Sepatu Keren (1x) - Rp 250.000</li>
    </ul>
    <hr>
    <a href="{{ route('checkout') }}"><button style="padding: 10px 20px; background: green; color: white; border: none; cursor: pointer;">Lanjut ke Checkout</button></a>
@endsection
