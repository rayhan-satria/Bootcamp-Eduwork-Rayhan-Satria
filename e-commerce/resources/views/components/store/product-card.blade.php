@props(['product'])

<div class="product-card h-100 rounded" style="background-color: #FDF0D5">

    <a href="{{ route('products.show', $product->slug) }}"
       class="text-decoration-none">

        @if ($product->image)
            <div class="card w-100 style-container-image" style="height: 250px; overflow: hidden;">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="product-image card-img-top object-cover w-100 h-100"
                >
            </div>
        @else
            <div class="product-image bg-body-secondary d-flex align-items-center justify-content-center">
                <i class="bi bi-image fs-1 text-secondary"></i>
            </div>
        @endif

    </a>

    <div class="p-3 card-body">

        <span class="small text-secondary">
            {{ $product->category->name ?? 'Uncategorized' }}
        </span>

        <h5 class="fw-semibold mt-1 card-title">
            {{ $product->name }}
        </h5>

        <div class="d-flex justify-content-between align-items-center mt-3">

            <span class="fw-bold" style="color: var(--coffee-brown);">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>

            <a href="{{ route('products.show', $product->slug) }}"
               class="btn btn-light btn-outline-dark">
                Detail
            </a>

        </div>

    </div>

</div>
