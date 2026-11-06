
@props(['category'])

<a href="{{ route('categories.show', $category->slug) }}"
   class="category-card text-decoration-none">

    <div class="category-card-content">

        <h4 class="fw-bold mb-2">
            {{ $category->name }}
        </h4>

        <p class="text-secondary mb-0">
            {{ $category->description ?? 'Explore our collection.' }}
        </p>

        <span class="d-inline-block mt-3 fw-semibold"
              style="color: var(--coffee-brown);">
            Explore Category
            <i class="bi bi-arrow-right ms-1"></i>
        </span>

    </div>

</a>
