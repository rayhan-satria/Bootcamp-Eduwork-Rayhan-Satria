
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>coffea</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="/css/style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
        <a class="navbar-brand fw-bold f-play" href="/products" style="font-size: 24px;">
            coffea
        </a>
    </div>
</nav>

  <!-- Hero Banner -->
  <div class="hero-banner text-center">
    <div class="container">
        <h1 class="display-4 fw-bold f-outfit">WELCOME</h1>
        <p class="lead f-play">Elevate Your Daily Coffee Ritual with Coffea’s Premium Roasts <br>Discover rich, locally-sourced flavors and a warm atmosphere tailored for you.</p>
        <a href="#produk-section" class="btn btn-lg mt-3 f-poppins" style="color: white;">Order Now</a>
    </div>
  </div>

<main class="container py-5">

    <!-- Filter kategori -->
    <form action="/products" method="GET"
          class="row g-2 mb-4">

        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All category</option>

                <?php foreach ($categories as $item): ?>
                    <option
                        value="<?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>"
                        <?= $category === $item['category'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn">
                Filter
            </button>

            <a href="/products" class="btn">
                Reset
            </a>
        </div>

    </form>

    <!-- Informasi jumlah produk -->
    <p class="text-muted">
        found <?= count($products) ?> products
    </p>

    <!-- Daftar produk -->
    <div class="row g-4" id="produk-section">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $product): ?>

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                    <div class="card product-card h-100 shadow-sm">

                        <div class="card-body d-flex flex-column">

                            <span class="badge text-bg-secondary align-self-start mb-3" style="font-size: 16px;">
                                <?= htmlspecialchars($product['category'] ?? 'Lainnya', ENT_QUOTES, 'UTF-8') ?>
                            </span>

                            <div class="ratio ratio-1x1">
                                <img class="rounded card-img-top object-fit-cover" src="/<?= $product['images'] ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">
                            </div>

                            <h5 class="card-title mb-0 pt-2 f-play fw-bold">
                                <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                            </h5>

                            <p class="card-text text-muted mb-0 pb-2" style="font-size: 16px;">
                                <?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </p>

                            <h5 class="fw-bold mt-auto">
                                Rp <?= number_format((float) $product['price'], 0, ',', '.') ?>
                            </h5>

                            <p class="small text-muted">
                                Stock: <?= (int) $product['stock'] ?>
                            </p>

                            <button class="btn btn-dark w-100">
                                Order
                            </button>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">
                <div class="alert alert-warning">
                    Produk tidak ditemukan untuk kategori ini.
                </div>
            </div>

        <?php endif; ?>

    </div>

</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
