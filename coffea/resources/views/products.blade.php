@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="container my-4 p-4 bg-white rounded shadow-sm">
    <h1 class="text-center mb-2">☕ Menu</h1>
    <p class="text-center text-muted mb-4">Pick your favorite bites and brews.</p>
    
    <!-- 🎛️ TOMBOL FILTER KATEGORI DINAMIS -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
        <!-- Tombol Semua Menu -->
        <a href="{{ route('products.index') }}" 
           class="btn {{ request('category') == '' ? 'btn-dark' : 'btn-outline-dark' }} fw-bold px-3 py-2 text-capitalize">
            View All
        </a>

        <!-- Looping Tombol Kategori dari Database -->
        @foreach($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat->name]) }}" 
               class="btn {{ request('category') == $cat->name ? 'btn-dark' : 'btn-outline-dark' }} fw-bold px-3 py-2 text-capitalize">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <!-- Tampilkan notifikasi ijo kalau berhasil nambah barang -->
    @if(session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Grid Penampung Menu -->
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: flex-start;">
        @forelse($menus as $menu)
            <!-- CARD MENU -->
            <div style="
                border: 1px solid #ddd; 
                padding: 20px; 
                border-radius: 8px; 
                background: #fff; 
                width: calc(25% - 15px); 
                min-width: 250px; 
                box-shadow: 0 2px 5px rgba(0,0,0,0.05); 
                display: flex; 
                flex-direction: column; 
                justify-content: space-between;
            ">
                
                <div>
                    <!-- Bagian Gambar -->
                    <div style="width: 100%; height: 180px; border-radius: 6px; overflow: hidden; margin-bottom: 15px; background: #eee;">
                        @if($menu->image)
                            <img src="{{ Vite::asset('resources/images/' . strtolower($menu->category->name) . '/' . $menu->image) }}" alt="{{ $menu->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #aaa; font-size: 14px;">No Image</div>
                        @endif
                    </div>

                    <!-- Nama Kategori -->
                    <span style="font-size: 11px; background: #eee; padding: 3px 8px; border-radius: 12px; color: #555; font-weight: bold; text-transform: capitalize;">
                        {{ $menu->category->name }}
                    </span>
                    
                    <!-- Nama Menu -->
                    <h3 style="margin: 10px 0 5px 0; font-size: 18px;">{{ $menu->name }}</h3>
                    
                    <!-- Deskripsi -->
                    <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
                        {{ $menu->description }}
                    </p>
                </div>
                
                <!-- Harga & Tombol Pesan -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; padding-top: 10px; border-top: 1px solid #f5f5f5;">
                    <strong style="color: #e67e22; font-size: 16px;">Rp {{ number_format($menu->price, 0, ',', '.') }}</strong>
                    
                    <form action="{{ route('cart.add', $menu->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm fw-bold">+ Order</button>
                    </form>
                </div>
                
            </div>
        @empty
            <!-- Antisipasi kalau kategori tersebut belum ada produknya -->
            <div class="w-100 text-center py-5 text-muted">
                ❌ This flavor is coming soon.
            </div>
        @endforelse
    </div>

    <!-- Tombol Navigasi Pagination -->
    <div class="mt-5 d-block px-2">
        {{ $menus->links() }}
    </div>
</div>
@endsection
