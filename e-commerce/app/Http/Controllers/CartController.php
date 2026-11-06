<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = auth()->user()->cart()
            ->firstOrCreate();

        $cartItems = $cart->cartItems()
            ->with('product')
            ->get();
            
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;     
        });

        return view('cart.index', compact(
            'cartItems',
            'total',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        if ($product->stock < 1) {
            return back()->with('error', 'Stok produk habis');
        }

        $quantity = $request->input('quantity', 1);

        $cart = auth()->user()->cart()
            ->firstOrCreate();

        $cartItem = $cart->cartItems()
            ->where('product_id', $product->id)
            ->first();

        $newQuantity = ($cartItem?->quantity ?? 0) + $quantity;

        if ($newQuantity > $product->stock) {
            return back()->with('error', 'Melebihi stok tersedia');
        }

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Ditambahkan ke pesanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItems $cartItem)
    {
        $cart = auth()->user()->cart;

        abort_unless(
            $cart && $cartItem->cart_id === $cart->id,
            404
        );

        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $cartItem->product->stock,
            ],
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')
            ->with('success', 'Pesanan ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItems $cartItem)
    {
        $cart = auth()->user()->cart;

        abort_unless(
            $cart && $cartItem->cart_id === $cart->id,
            404
        );

        $cartItem->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Pesanan dibatalkan');
    }
}
