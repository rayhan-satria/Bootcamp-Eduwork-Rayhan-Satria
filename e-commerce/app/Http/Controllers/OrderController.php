<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    // Menampilkan riwayat pesanan
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = auth()->user()->cart;

        if (!$cart) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong');
        }

        $cartItems = $cart->cartItems()
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // Menampilkan detail pesanan
    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 404);

        $order->load(['orderItems', 'user']);

        return view('orders.show', compact('order'));
    }
    // Memproses checkout
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|min:10|max:1000',
        ]);

        $user = auth()->user();

        $order = DB::transaction(function () use ($user, $validated) {

            // Mengunci cart user selama proses checkout
            $cart = Cart::where('user_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (!$cart) {
                throw ValidationException::withMessages([
                    'cart' => 'Keranjang masih kosong',
                ]);
            }

            $cartItems = $cart->cartItems()
                ->get();

            if ($cartItems->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'keranjang masih kosong',
                ]);
            }

            $orderItemsData = [];
            $totalPrice = 0;

            // Validasi stok dan ambil harga terkini
            foreach ($cartItems as $cartItem) {

                $product = Product::whereKey($cartItem->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'Salah satu produk habis',
                    ]);
                }

                if ($product->stock < $cartItem->quantity) {
                    throw ValidationException::withMessages([
                        'stock' => "Stok {$product->name} tidak cukup",
                    ]);
                }

                $subtotal = $product->price * $cartItem->quantity;

                $totalPrice += $subtotal;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $subtotal,
                ];

                // Kurangi stok produk
                $product->decrement('stock', $cartItem->quantity);
            }

            // Buat data pesanan utama
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_price' => $totalPrice,
                'shipping_address' => $validated['shipping_address'],
                'status' => 'pending',
            ]);

            // Simpan rincian produk pesanan
            $order->orderItems()->createMany($orderItemsData);

            // Kosongkan keranjang
            $cart->cartItems()->delete();

            return $order;
        });

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Pesanan diperbarui');
    }
}