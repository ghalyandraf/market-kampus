<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk milik seller
    public function index()
    {
        $seller = Seller::where('user_id', Auth::id())->first();

        if (! $seller) {
            return redirect()->route('seller.dashboard')->with('error', 'Profil UMKM belum diatur.');
        }

        $products = Product::where('seller_id', $seller->id)->with('category')->get();
        $categories = Category::all();

        return view('seller.products', compact('products', 'categories', 'seller'));
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $seller = Seller::where('user_id', Auth::id())->first();

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'seller_id' => $seller->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $seller = Seller::where('user_id', Auth::id())->first();
        $product = Product::where('id', $id)->where('seller_id', $seller->id)->firstOrFail();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
