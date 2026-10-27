<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
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
        <a class="navbar-brand fw-bold" href="/products">coffea - Admin</a>
    </div>
</nav>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="fw-bold h3 mb-4">Edit Product</h1>
                    
                    <!-- Form mengarah ke route /products/update dengan membawa ID produk -->
                    <form action="/products/update?id=<?= $product['id'] ?>" method="POST">
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" required value="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">Category</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="" disabled>-- Pick a Category --</option>
                                
                                <?php foreach ($categories as $item): ?>
                                    <option value="<?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>" 
                                        <?= $product['category'] === $item['category'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-semibold">Price (Rp)</label>
                                <input type="number" name="price" id="price" class="form-control" required value="<?= (float) $product['price'] ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label fw-semibold">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control" required value="<?= (int) $product['stock'] ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Image Path</label>
                            <input type="text" name="images" id="images" class="form-control" required value="<?= htmlspecialchars($product['images'], ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                            <a href="/" class="btn btn-outline-secondary px-4">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
