
<?php

// models/ untuk query dan pengambilan data

class Product
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    // Mengambil semua produk
    public function getAll(): array
    {
        $sql = "SELECT * FROM products ORDER BY id DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    // Mengambil produk berdasarkan kategori
    public function getByCategory(string $category): array
    {
        $sql = "SELECT * FROM products
                WHERE category = :category
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'category' => $category
        ]);

        return $stmt->fetchAll();
    }

    // Mengambil daftar kategori unik
    public function getCategories(): array
    {
        $sql = "SELECT DISTINCT category
                FROM products
                WHERE category IS NOT NULL
                AND category <> ''
                ORDER BY category ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    // Menghapus produk berdasarkan ID
    public function delete(int $id): bool
    {
        // 1. Tulis query SQL untuk menghapus data berdasarkan Id
        $sql = "DELETE FROM products WHERE id = :id";
        // 2. Siapkan query menggunakan mekanisme prepare statement PDO agar aman
        $stmt = $this->db->prepare($sql);
        // 3. Eksekusi query dengan memasukkan variabel ID
        return $stmt->execute([
            'id' => $id
        ]);
    }

    // Menambahkan produk baru ke Database
    public function create(array $data) : bool
    {
        // 1. Tulis query SQL INSERT sesuai dengan nama kolom di database
        $sql = "INSERT INTO products (name, description, price, stock, category, images)
                VALUES (:name, :description, :price, :stock, :category, :images)";    
        // 2. Siapkan query dengan prepare statements agar aman dari SQL injection
        $stmt = $this->db->prepare($sql);
        // 3. Eksekusi query dengan memasukkan array data dari controller
        return $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'category' => $data['category'],
            'images' => $data['images']
        ]);
    }

    // Edit produk 
    public function getById(int $id): array|false
    {
        $sql = "SELECT * FROM products where id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Memperbarui data produk yg sudah ada
    public function update(int $id, array $data) : bool
    {
        $sql = "UPDATE products
                SET name = :name, description = :description, price = :price, stock = :stock, category = :category, images = :images
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'category' => $data['category'],
            'images' => $data['images'],
        ]);
    }
}
?>