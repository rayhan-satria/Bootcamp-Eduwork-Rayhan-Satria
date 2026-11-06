
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold fs-3"
           href="{{ route('home') }}"
           style="font-family: 'Playfair Display', serif; color: var(--coffee-brown);">
            coffea<span style="color: var(--coffee-accent);">.</span>
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#storeNavbar"
                aria-controls="storeNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="storeNavbar">

            <ul class="navbar-nav mx-auto gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#categories">
                        Categories
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">

                @auth
                    <a href="{{ route('cart.index') }}"
                       class="nav-link"
                       title="Shopping Cart">
                        <i class="bi bi-cart3 fs-5"></i>
                    </a>

                    <a href="{{ route('orders.index') }}"
                       class="nav-link">
                        My Orders
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-outline-dark">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="btn btn-coffee">
                        Register
                    </a>
                @endauth

            </div>

        </div>
    </div>
</nav>
