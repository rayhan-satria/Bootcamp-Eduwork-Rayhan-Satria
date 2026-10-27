<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/products">Coffea - Admin</a>
    </div>
</nav>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="fw-bold h3 mb-4">Add Menu</h1>
                    
                    <!-- Form mengarah ke route /products/store untuk proses simpan data -->
                    <form action="/products/store" method="POST">
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Menu Name</label>
                            <input type="text" name="name" id="name" class="form-control" required placeholder="Example: Kopi Susu Aren">
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="" disabled selected>-- Pick a Category --</option>
                                <?php foreach ($categories as $item): ?>    
                                    <option>
                                        <?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-semibold">Price (Rp)</label>
                                <input type="number" name="price" id="price" class="form-control" required placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label fw-semibold">Stock</label>
                                <input type="number" name="stock" id="stock" class="form-control" required placeholder="0">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Image Path</label>
                            <input type="text" name="images" id="images" class="form-control" required placeholder="Example: images/kopi-susu.jpg">
                            <div class="form-text text-muted">path file gambar ada di folder public/images/kategori.</div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Add description of the products..."></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Add Menu</button>
                            <a href="/products" class="btn btn-outline-secondary px-4">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>
