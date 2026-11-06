
@props(['category'])

<a href="{{ route('categories.show', $category->slug) }}"
   class="category-card text-decoration-none">

    <div class="p-4 h-100">

        <span class="small text-uppercase">
            Explore Category
        </span>

        <h4 class="fw-bold mt-2">
            {{ $category->name }}
        </h4>

        <p class="mb-3">
            {{ $category->description ?? 'Explore our collection.' }}
        </p>

        <span class="fw-semibold">
            Explore <i class="bi bi-arrow-right ms-1"></i>
        </span>

    </div>

</a>
