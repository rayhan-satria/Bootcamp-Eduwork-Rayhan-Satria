<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Produk</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/products">
            TokoOnline
        </a>
    </div>
</nav>

<main class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Daftar Produk</h1>
            <p class="text-muted mb-0">
                Temukan produk yang lu butuhkan.
            </p>
        </div>
    </div>

    <!-- Filter kategori -->
    <form action="/products" method="GET"
          class="row g-2 mb-4">

        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">Semua Kategori</option>

                    <?php foreach ($category as $item): ?>
                        <option
                            value="<?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>"
                            <?= (isset($_GET['category']) && $_GET['category'] === $item['category']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>

            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                Filter
            </button>

            <a href="/products" class="btn btn-outline-secondary">
                Reset
            </a>
        </div>

    </form>

    <!-- Informasi jumlah produk -->
    <p class="text-muted">
        Menampilkan <?= count($products) ?> produk
    </p>

    <!-- Daftar produk -->
    <div class="row g-4">

        <?php if (count($products) > 0): ?>

            <?php foreach ($products as $product): ?>

                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                    <div class="card product-card h-100 shadow-sm">

                        <div class="card-body d-flex flex-column">

                            <span class="badge text-bg-secondary align-self-start mb-2">
                                <?= htmlspecialchars($product['kategori'] ?? 'Lainnya', ENT_QUOTES, 'UTF-8') ?>
                            </span>

                            <h5 class="card-title">
                                <?= htmlspecialchars($product['nama_produk'], ENT_QUOTES, 'UTF-8') ?>
                            </h5>

                            <p class="card-text text-muted">
                                <?= htmlspecialchars($product['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </p>

                            <h5 class="text-primary fw-bold mt-auto">
                                Rp <?= number_format((float) $product['harga'], 0, ',', '.') ?>
                            </h5>

                            <p class="small text-muted">
                                Stok: <?= (int) $product['stok'] ?>
                            </p>

                            <button class="btn btn-dark w-100" disabled>
                                Detail Produk
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

</body>
</html>
