
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
}

?>