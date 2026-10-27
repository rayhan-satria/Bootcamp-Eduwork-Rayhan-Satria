
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

    public function delete(): void
    {
        // 1. Ambil ID dari query string URL
        $id = (int) ($_GET['id'] ?? 0);
        // 2. validasi singkat, jika ID valid, eksekusi
        if ($id > 0) {
            $this->product->delete($id);
        }
        // 3. Alihkan halaman kembali ke daftar produk
        header('Location: /');
        exit;
    }

    // 1. Fungsi untuk menampilkan halaman form
    public function create() : void
    {
        // Ambil daftar kategori unik dari database
        $categories = $this->product->getCategories();
        // Langsung panggil file form yg sudah dibuat
        require __DIR__ . '/../views/products/create.php';   
    }
    // 2. Fungsi untuk memproses data yg dikirim dari form
    public function store() : void {
        // Hanya menerima request dengan metode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Tangkap semua data dari $_POST dan rapikan sedikit dengan trim()
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'price' => trim($_POST['price'] ?? '0'),
                'stock' => trim($_POST['stock'] ?? '0'),
                'category' => trim($_POST['category'] ?? ''),
                'images' => trim($_POST['images'] ?? ''),
            ];

            // Panggil fungsi create() milik MODELS untuk dimasukkan ke database
            $this->product->create($data);
        }

        // Setelah selesai simpan, user kembali ke halaman utama
        header('Location: /');
        exit;
    }

    // Menampilkan halaman form edit dengan data lama yg sudah terisi
    public function edit() : void
    {
        $id = (int) ($_GET['id'] ?? 0);

        // Ambil data produk lama berdasarkan ID
        $product = $this->product->getById($id);

        // Jika produk tidak ditemukan, balik ke halaman utama
        if (!$product) {
            header('Location: /');
            exit;
        }
        
        // Ambil daftar kategori unik untuk dropdown
        $categories = $this->product->getCategories();

        // Panggil file view edit
        require __DIR__ . '/../views/products/edit.php';
    }

    // Memproses perubahan data dari form edit
    public function update() : void
    {
        $id = (int) ($_GET['id'] ?? 0);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0 ) {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'description' => trim($_POST['description'] ?? ''),
                'price' => trim($_POST['price'] ?? '0'),
                'stock' => trim($_POST['stock'] ?? '0'),
                'category' => trim($_POST['category'] ?? ''),
                'images' => trim($_POST['images'] ?? ''),
            ];

            // Eksekusi update data di model
            $this->product->update($id, $data);
        }

        // Kembali ke halaman utama
        header('Location: /');
        exit;
    }
}

?>