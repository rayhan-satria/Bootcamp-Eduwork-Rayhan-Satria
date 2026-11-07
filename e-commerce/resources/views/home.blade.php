
@extends('layouts.store')

@section('title', 'Home - E-commerce')

@section('content')

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <div class="hero-content">

                        <span class="hero-label mb-3" style="font-family: 'Playfair Display', serif; ">
                            WELCOME TO E-COMMERCE
                        </span>

                        <h1 class="hero-title">
                            The perfect find for a perfect lifestyle.
                        </h1>

                        <p class="hero-description">
                            Discover your favorite items
                            And enjoy every moment with a touch of happiness.
                        </p>

                        <a href="{{ route('products.index') }}"
                           class="btn" style="background-color: #A77464">
                            Explore Products
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                    </div>
                </div>

                <div class="col-lg-6">
                    <img
                        src="{{ asset('storage/background.avif') }}"
                        alt="hero"
                        class="hero-image"
                        style="width: 109.4%; height: 100%; max-height: 80vh; object-fit: contain; object-position: center;"
                    >
                </div>

            </div>
        </div>
    </section>


    <!-- CATEGORY SECTION -->
    <section class="section-padding pb-3" id="categories" style="background-color: #BEB1B8">
        <div class="container">

            <div class="text-center py-3">
                <span class="section-label">OUR COLLECTION</span>
                <h2 class="section-title mb-4">Check Our Category</h2>
            </div>

            <div class="row g-3">

                @foreach ($categories as $category)

                    <div class="col-md-3">
                        <x-store.category-card :category="$category" />
                    </div>

                @endforeach
            </div>
        </div>
    </section>


    <!-- FEATURED PRODUCTS -->
    <section class="section-padding bg-light py-3">
        <div class="container">

                <div class="text-center">
                    <span class="section-label">OUR PRODUCTS</span>
                    <h2 class="section-title mt-2">Featured Products</h2>
                </div>

            <div class="d-flex justify-content-between align-items-center mb-2">


                <a href="{{ route('products.index') }}"
                   class="text-decoration-none text-dark">
                    View All
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="row g-4">

                @foreach ($products as $product)

                    <div class="col-6 col-md-4 col-lg-3">
                        <x-store.product-card :product="$product" />
                    </div>

                @endforeach
            </div>

        </div>
    </section>

@endsection
