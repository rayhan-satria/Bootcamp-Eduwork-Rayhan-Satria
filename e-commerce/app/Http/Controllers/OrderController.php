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
        // Cek apakah user sedang menggunakan mode Buy Now
        $buyNow = session('buy_now');

        if ($buyNow) {
            $product = Product::find($buyNow['product_id']);

            if (!$product || $product->stock < $buyNow['quantity']) {
                session()->forget('buy_now');

                return redirect()
                    ->back()
                    ->with('error', 'Produk tidak tersedia atau stok tidak mencukupi');
            }

            $cartItems = collect([
                (object) [
                    'product' => $product,
                    'quantity' => $buyNow['quantity'],
                ]
            ]);

            $total = $product->price * $buyNow['quantity'];

        return view('checkout.index', compact(
            'cartItems',
            'total'
        ))->with('isBuyNow', true);        
        
        }

        // Checkout reguler dari keranjang
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

    return view('checkout.index', compact(
        'cartItems',
        'total'
    ))->with('isBuyNow', false);    

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
            'checkout_mode' => 'required|in:cart,buy_now',
        ]);

        $user = auth()->user();

        $isBuyNow = $validated['checkout_mode'] === 'buy_now';
        $buyNow = session('buy_now');

        if ($isBuyNow && !$buyNow) {
            return redirect()
                ->route('products.index')
                ->with('error', 'Data Buy Now tidak ditemukan');
        }

        $order = DB::transaction(function () use (
            $user,
            $validated,
            $isBuyNow,
            $buyNow
        ) {
            $cart = null;

            if ($isBuyNow) {
                $items = collect([
                    (object) [
                        'product_id' => $buyNow['product_id'],
                        'quantity' => $buyNow['quantity'],
                    ],
                ]);
            } else {
                $cart = Cart::where('user_id', $user->id)
                    ->lockForUpdate()
                    ->first();

                if (!$cart) {
                    throw ValidationException::withMessages([
                        'cart' => 'Keranjang masih kosong',
                    ]);
                }

                $items = $cart->cartItems()->get();

                if ($items->isEmpty()) {
                    throw ValidationException::withMessages([
                        'cart' => 'Keranjang masih kosong',
                    ]);
                }
            }

            $orderItemsData = [];
            $totalPrice = 0;

            foreach ($items as $item) {
                $product = Product::whereKey($item->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'product' => 'Produk tidak ditemukan',
                    ]);
                }

                $quantity = (int) $item->quantity;

                if ($quantity < 1 || $product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'stock' => "Stok {$product->name} tidak cukup",
                    ]);
                }

                $subtotal = $product->price * $quantity;

                $totalPrice += $subtotal;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];

                $product->decrement('stock', $quantity);
            }

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_price' => $totalPrice,
                'shipping_address' => $validated['shipping_address'],
                'status' => 'pending',
            ]);

            $order->orderItems()->createMany($orderItemsData);

            // Hanya checkout keranjang yang mengosongkan keranjang
            if (!$isBuyNow) {
                $cart->cartItems()->delete();
            }

            return $order;
        });

        if ($isBuyNow) {
            session()->forget('buy_now');
        }

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat');
    }
}