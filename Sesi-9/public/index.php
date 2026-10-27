<?php
session_start();

require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../controllers/CartController.php';

$pdo = require __DIR__ . '/../config/database.php';

// Membaca URL yang diminta
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Router sederhana
switch ($path) {
    case '/':
        $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        header('Location: /products' . $queryString);
        exit;

    case '/products':
        $controller = new ProductController($pdo);
        $controller->index();
        break;
    
    case '/products/delete':
        $controller = new ProductController($pdo);
        $controller->delete();
        break;
    
    case '/products/create':
        $controller = new ProductController($pdo);
        $controller->create();
        break;

    case '/products/store':
        $controller = new ProductController($pdo);
        $controller->store();
        break;
    
    case '/products/edit':
        $controller = new ProductController($pdo);
        $controller->edit();
        break;
    
    case '/products/update':
        $controller = new ProductController($pdo);
        $controller->update();
        break;
    
    case '/cart':
        $controller = new CartController($pdo);
        $controller->index();
        break;
    
    case '/cart/add':
        $controller = new CartController($pdo);
        $controller->add();
        break;

    case '/cart/clear':
        $controller = new CartController($pdo);
        $controller->clear();
        break;

    case '/cart/checkout':
        $controller = new CartController($pdo);
        $controller->checkout();
        break;

    default:
        http_response_code(404);
        echo '404 - Halaman tidak ditemukan';
        break;
}

?>