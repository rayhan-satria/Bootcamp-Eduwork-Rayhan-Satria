<?php

use Illuminate\Support\Facades\Route;

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

?>