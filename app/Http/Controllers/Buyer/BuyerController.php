<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuyerController extends Controller
{
    // 1. Katalog Produk
    public function index(Request $request)
    {
        $query = Product::with(['seller.campus', 'category'])->where('is_active', true);

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('buyer.catalog', compact('products', 'categories'));
    }

    // 2. Tambah ke Keranjang
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // 3. Tampilkan Keranjang Belanja
    public function cartIndex()
    {
        $cart = Cart::with('items.product.seller')->where('user_id', Auth::id())->first();
        $items = $cart ? $cart->items : [];

        return view('buyer.cart', compact('items'));
    }

    // 4. Hapus Item dari Keranjang
    public function removeCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    // 5. Proses Checkout & Buat Pesanan (Order)
    public function checkout(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
        ]);

        $cart = Cart::with('items.product.seller')->where('user_id', Auth::id())->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('buyer.cart')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Untuk MVP sederhana, kita asumsikan item dalam cart berasal dari 1 seller utama
        $firstItem = $cart->items->first();
        $sellerId = $firstItem->product->seller_id;

        DB::beginTransaction();
        try {
            $totalProductPrice = 0;
            foreach ($cart->items as $item) {
                $totalProductPrice += $item->product->price * $item->quantity;
            }

            // Ongkir statis/sederhana untuk MVP (misal: Rp 5.000)
            $shippingCost = 5000;
            $totalAmount = $totalProductPrice + $shippingCost;

            // Buat pesanan baru
            $order = Order::create([
                'buyer_id' => Auth::id(),
                'seller_id' => $sellerId,
                'status' => 'pending',
                'total_product_price' => $totalProductPrice,
                'shipping_cost' => $shippingCost,
                'total_amount' => $totalAmount,
                'delivery_address' => $request->delivery_address,
                'otp_code' => rand(1000, 9999), // Kode OTP untuk driver nanti
            ]);

            // Pindahkan item cart ke order_items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }

            // Kosongkan keranjang setelah checkout
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('buyer.orders')->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi seller.');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Gagal memproses pesanan: '.$e->getMessage());
        }
    }

    // 6. Riwayat Pesanan Buyer
    public function ordersIndex()
    {
        $orders = Order::with(['seller', 'items.product'])->where('buyer_id', Auth::id())->latest()->get();

        return view('buyer.orders', compact('orders'));
    }
}
