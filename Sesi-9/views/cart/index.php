<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart - coffea</title>
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
        <a class="navbar-brand fw-bold f-play" href="/">coffea</a>
        <a href="/" class="btn btn-outline-light btn-sm">Order again</a>
    </div>
</nav>

<main class="container py-5">
    <h1 class="fw-bold mb-4 f-play">Your Orders</h1>

    <?php if (!empty($cartItems)): ?>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th style="width: 100px;">Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalBelanja = 0;
                        foreach ($cartItems as $id => $item): 
                            $subtotal = $item['price'] * $item['qty'];
                            $totalBelanja += $subtotal;
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="/<?= $item['image'] ?>" class="rounded object-fit-cover" style="width: 50px; height: 50px;">
                                        <span class="fw-semibold"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></span>
                                    </div>
                                </td>
                                <td>Rp <?= number_format((float)$item['price'], 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge bg-secondary p-2 fs-6 w-100"><?= $item['qty'] ?></span>
                                </td>
                                <td class="fw-bold">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <tr class="table-light fs-5">
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td class="fw-bold">Rp <?= number_format($totalBelanja, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="/cart/clear" class="btn fw-semibold" onclick="return confirm('Having a doubt?')">
                        Reset Order
                    </a>
                    <a href="/cart/checkout" class="btn fw-bold px-4" onclick="alert('Sit back chief, we`re on it!')">
                        Order
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning py-4">
            <h4 class="alert-heading fw-bold">Don't be shy, Order up!</h4>
            <p class="mb-0">Pick a menu</p>
            <hr>
            <a href="/" class="btn btn-warning fw-bold">Menu</a>
        </div>
    <?php endif; ?>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
