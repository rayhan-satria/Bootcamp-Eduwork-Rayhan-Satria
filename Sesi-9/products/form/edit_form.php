<?php

require "../../koneksi_db.php"; // ../ naik tingkat folder (include db connection file)

// get the product ID from query string
$id = $_GET['id'];

// read the product data
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$product = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"><br>
        <label for="price">Harga</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>"><br>
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" value="<?php echo htmlspecialchars($product['description']); ?>"></textarea><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>