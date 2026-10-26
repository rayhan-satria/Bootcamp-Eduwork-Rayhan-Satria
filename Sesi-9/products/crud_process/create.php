<?php

require "../../koneksi_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products (name, price, description, stock) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $price, $description, $stock]);

    header('location: ../index.php');
    exit;
}

?>