<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collectionpaginate;
use App\Models\ProductCategories;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori buat ditampilin jadi tombol filter
        $categories = ProductCategories::all();

        // 2. Query dasar: ambil produk terbaru
        $query = Product::latest();

        // 3. CORE LOGIC: Jika user nge-klik filter kategori tertentu
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        // 4. Batasi menu per halaman (sesuaikan angka biar pagination jalan pas difilter)
        // appends() berfungsi menjaga agar filter kategori gak ilang pas user klik halaman 2, 3, dst.
        $menus = $query->paginate(8)->appends(['category' => $request->category]);
        
        return view('products', compact('menus', 'categories'));
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
