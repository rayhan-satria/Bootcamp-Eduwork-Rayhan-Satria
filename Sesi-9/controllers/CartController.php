<?php
// controllers/CartController.php

require_once __DIR__ . '/../models/Product.php';

class CartController
{
    private Product $product;

    public function __construct(PDO $pdo)
    {
        $this->product = new Product($pdo);
    }

    // 1. Menampilkan halaman daftar isi keranjang
    public function index(): void
    {
        // Ambil data keranjang dari session, jika belum ada set jadi array kosong
        $cartItems = $_SESSION['cart'] ?? [];
        
        require __DIR__ . '/../views/cart/index.php';
    }

    // 2. Memproses penambahan produk ke keranjang
    public function add(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $productData = $this->product->getById($id);

        if ($productData) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['qty']++;
            } else {
                $_SESSION['cart'][$id] = [
                    'name'  => $productData['name'],
                    'price' => $productData['price'],
                    'qty'   => 1,
                    'image' => $productData['images']
                ];
            }
        }

        $oldCategory = trim($_GET['category'] ?? '');
        $anchor = isset($_GET['anchor']) ? '#' . $_GET['anchor'] : '';
        
        // Susun ulang URL tujuan balik
        $redirectTo = '/';
        if ($oldCategory !== '') {
            $redirectTo .= '?category=' . urlencode($oldCategory);
        }

        session_write_close();
        header('Location: ' . $redirectTo . $anchor); // Contoh hasil: /?category=Hot+Coffee#produk-section
        exit;
    }

    // 3. Mengosongkan isi keranjang
    public function clear(): void
    {
        unset($_SESSION['cart']);
        header('Location: /cart');
        exit;
    }

    public function checkout() : void 
    {
        // 1. Hapus memori session cart
        unset($_SESSION['cart']);
        
        // 2. Alihkan halaman langsung kembali ke halaman utama
        header('Location: /');
        exit;
    }
}
