
<?php

// config/ untuk konfigurasi koneksi database
// koneksi menggunakan PDO

$host = 'localhost';
$dbname = 'coffea';
$username = 'root';
$password = 'Han102002';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
   // echo 'Koneksi berhasil';
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('Koneksi database gagal.');
}

return $pdo;

?>