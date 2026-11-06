<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// HOME
Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// PRODUCTS
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');


// PRODUCT CATEGORIES
Route::get('/categories/{productCategory:slug}', [ProductCategoryController::class, 'show'])
    ->name('categories.show');

// ROUTE PRODUCTS UNTUK ADMIN
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/products', [ProductController::class, 'manage'])
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    Route::get('/categories', [ProductCategoryController::class, 'manage'])
        ->name('categories.index');

    Route::get('/categories/create', [ProductCategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [ProductCategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{productCategory}/edit', [ProductCategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{productCategory}', [ProductCategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{productCategory}', [ProductCategoryController::class, 'destroy'])
        ->name('categories.destroy');

    });
// AUTHENTICATED USER
Route::middleware('auth')->group(function () {
            
    // CART
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');
            
    Route::post('/cart/items/{product}', [CartController::class, 'store'])
        ->name('cart.store');
            
    Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])
        ->name('cart.update');
            
    Route::delete('/cart/items/{cartItem}', [CartController::class, 'destroy'])
        ->name('cart.destroy');
    
    // CHECKOUT
    Route::get('/checkout', [OrderController::class, 'create'])
        ->name('checkout.index');
        
    Route::post('/checkout', [OrderController::class, 'store'])
        ->name('checkout.store');

    // ORDERS
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::post('/checkout', [OrderController::class, 'store'])
        ->name('checkout.store');

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Breeze auth routes
require __DIR__.'/auth.php';
