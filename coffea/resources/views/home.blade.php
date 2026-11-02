@extends('layouts.app')

@section('title', 'Selamat Datang di Kafe Online')

@section('content')
    <!-- 1. HERO BANNER SECTION (Lebar Mentok Kanan-Kiri Layar) -->
    <div style="
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ Vite::asset('resources/images/espresso-surrounded-by-scattered-coffee-beans-dark-surface-1-6ac0cb3224864.avif') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 70vh; /* Tinggi banner 70% dari tinggi layar browser */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    ">
        <div class="px-3">
            <h1 class="display-3 fw-bold mb-3 f-play">WELCOME!</h1>
            <p class="lead mb-4 f-outfit" style="font-size: 24px; max-width: 700px; margin: 0 auto; color: #f1f2f6;">
                Elevate Your Daily Coffee Ritual with Coffea’s Premium Roasts 
                Discover rich, locally-sourced flavors and a warm atmosphere tailored for you.            </p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg fw-bold px-4 py-3 shadow">
                📖 Menu
            </a>
        </div>
    </div>

    <!-- 2. SECTION ISI KONTEN -->
    <div class="container my-5 py-4" style="background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div class="row text-center">
            <h2 class="fw-bold mb-4" style="color: #2c3e50;">Your new favorite spot! <br> Where good vibes and great taste meets</h2>
            
            <div class="col-md-4 mb-4">
                <div class="p-3">
                    <span style="font-size: 40px;">⚡</span>
                    <h4 class="fw-bold mt-2">Blazing Fast Wi-Fi</h4>
                    <p class="text-muted">Fast internet only. Perfect for your remote work sessionsm zoom calls, or just endless scrolling.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="p-3">
                    <span style="font-size: 40px;">☕</span>
                    <h4 class="fw-bold mt-2">Premium Coffee Beans</h4>
                    <p class="text-muted">High-quality beans only. Brewed carefully to give you that instant mood booster in every sip.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="p-3">
                    <span style="font-size: 40px;">🍟</span>
                    <h4 class="fw-bold mt-2">Addictive Bites</h4>
                    <p class="text-muted">Good food, good mood. Seriously, one bite of our snack will never be enough.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
