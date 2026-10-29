<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products'); // Mengarah ke resources/views/products.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Form tambah produk";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Proses menyimpan produk ke db";
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return "Menampilkan detail produk: " . $product->name;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return "Form edit untuk produk: " . $product->name;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        return "Proses mengupdate data produk ID: " . $product->id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return "Proses menghapus produk ID: " . $product->id;
    }
}
