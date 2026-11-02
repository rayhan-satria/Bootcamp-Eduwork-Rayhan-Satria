<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Models\Product;

// --- MENGELOLA HALAMAN (PagesController) ---
Route::get('/', [PagesController::class, 'home'])->name('home');
// Route::get('/about', [PagesController::class, 'about'])->name('about');
// Route::get('/contact', [PagesController::class, 'contact'])->name('contact');


// --- MENGELOLA PRODUK (ProductController - Resource CRUD) ---
// Perintah tunggal ini otomatis bikinin route untuk index, create, store, show, edit, update, destroy
Route::resource('products', ProductController::class);


// --- ROUTE SISA SESI ---

// Jalur buat nampilin halaman keranjang (membaca data session)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Jalur buat memproses pas user ngeklik tombol "+ Pesan"
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// Jalur Baru untuk Update Quantity (Tambah/Kurang)
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Jalur Baru untuk Hapus Menu dari Keranjang
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
