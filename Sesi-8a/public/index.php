
<?php

require_once __DIR__ . '/../controllers/ProductController.php';

$pdo = require __DIR__ . '/../config/database.php';

// Membaca URL yang diminta
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Router sederhana
switch ($path) {
    case '/':
        header('Location: /products');
        exit;

    case '/products':
        $controller = new ProductController($pdo);
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo '404 - Halaman tidak ditemukan';
        break;
}

?>