
<footer class="store-footer py-5" style="background-color: #a77464;">
    <div class="container">

        <div class="row g-4">

            <div class="col-md-5">
                <h3 class="fw-bold mb-3"
                    style="font-family: 'Playfair Display', serif;">
                    E-Commerce.
                </h3>

                <p class="text-light opacity-75">
                    We bring you the absolute best essentials,
                    The perfect choice for every lifestyle.
                </p>
            </div>

            <div class="col-md-3">
                <h6 class="fw-bold mb-3">Explore</h6>

                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-decoration-none text-white opacity-75">Home</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('products.index') }}" class="text-decoration-none text-white opacity-75">Products</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('home') }}#categories" class="text-decoration-none text-white opacity-75">Categories</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Contact</h6>

                <p class="text-light opacity-75 mb-2">
                    <i class="bi bi-envelope me-2"></i>
                    hello@ecommerce.com
                </p>

                <p class="text-light opacity-75">
                    <i class="bi bi-geo-alt me-2"></i>
                    Indonesia
                </p>
            </div>

        </div>

        <hr class="border-light opacity-25 my-4">

        <div class="text-center text-light opacity-75 small">
            &copy; {{ date('Y') }} E-Commerce. All rights reserved.
        </div>

    </div>
</footer>
