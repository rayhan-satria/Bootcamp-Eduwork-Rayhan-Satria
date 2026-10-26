
<?php

// controller menerima permintaan, meminta data dari model, lalu meneruskannya ke view

require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private Product $product;

    public function __construct(PDO $pdo)
    {
        $this->product = new Product($pdo);
    }

    public function index(): void
    {
        // Membaca filter kategori dari URL
        $category = trim($_GET['category'] ?? '');

        // Memilih query sesuai filter
        if ($category !== '') {
            $products = $this->product->getByCategory($category);
        } else {
            $products = $this->product->getAll();
        }

        // Mengambil kategori untuk dropdown
        $categories = $this->product->getCategories();

        // Mengirim data ke View
        require __DIR__ . '/../views/products/index.php';
    }
}

?>