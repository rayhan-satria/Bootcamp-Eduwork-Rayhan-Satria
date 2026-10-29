<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return 'Route products';
});

Route::get('/cart', function () {
    return 'Route cart';
});

Route::get('/checkout', function () {
    return 'Route checkout';
});

Route::resource('products-resource', ProductsController::class);
?>