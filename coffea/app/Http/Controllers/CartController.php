<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 1. Tampilkan Halaman Cart berdasarkan data Session
    public function index()
    {
        // Ambil data keranjang dari session browser, kalau gak ada set jadi array kosong []
        $cart = session()->get('cart', []);
        
        return view('cart', compact('cart'));
    }

    // 2. Logika memasukkan produk ke dalam Session Cart
    public function add($id)
    {
        // Cari produknya di DB berdasarkan ID yang diklik
        $product = Product::with('category')->findOrFail($id);
        
        // Ambil data keranjang yang udah ada di session saat ini
        $cart = session()->get('cart', []);

        // Cek apakah menu ini udah pernah dipesan sebelumnya di keranjang?
        if(isset($cart[$id])) {
            // Kalau udah ada, tinggal tambahin jumlahnya (quantity + 1)
            $cart[$id]['quantity']++;
        } else {
            // Kalau belum ada, masukin data baru ke dalam array keranjang
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "category_name" => $product->category->name
            ];
        }

        // Simpan kembali data array terbaru ke dalam session browser
        session()->put('cart', $cart);

        // Lempar balik user ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Menu berhasil ditambahkan ke pesanan!');
    }
        // 3. Fungsi Tambah / Kurang Quantity
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Cek aksi apakah tambah atau kurang
            if ($request->action == 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action == 'decrease') {
                $cart[$id]['quantity']--;
                
                // Kalau quantity jadi 0 atau minus, otomatis hapus aja dari keranjang
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]);
                }
            }
            
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah pesanan berhasil diperbarui!');
    }

    // 4. Fungsi Hapus Item Menu
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]); // Hapus item dari array berdasarkan ID produk
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Menu berhasil dihapus dari pesanan.');
    }

}
