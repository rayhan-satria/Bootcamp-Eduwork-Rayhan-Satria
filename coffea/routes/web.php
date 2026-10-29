<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OrderController;

// --- MENGELOLA HALAMAN (PagesController) ---
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');


// --- MENGELOLA PRODUK (ProductController - Resource CRUD) ---
// Perintah tunggal ini otomatis bikinin route untuk index, create, store, show, edit, update, destroy
Route::resource('products', ProductController::class);


// --- ROUTE SISA SESI ---
Route::get('/cart', function () {
    return view('cart'); // Mengarah ke resources/views/cart.blade.php
})->name('cart.index');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
