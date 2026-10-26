<?php
// menampilkan daftar produk

require "../koneksi_db.php"; // include the database connection file

// read
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                ID: <?php echo htmlspecialchars($product['id']); ?><br>
                Name: <?php echo htmlspecialchars($product['name']); ?><br>
                Harga: <?php echo htmlspecialchars($product['price']); ?><br>
                Deskripsi: <?php echo htmlspecialchars($product['description']); ?><br>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>