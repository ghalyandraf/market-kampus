<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $seller = Seller::where('user_id', Auth::id())->first();
        if (! $seller) {
            return redirect()->route('seller.dashboard');
        }

        $orders = Order::with(['buyer', 'items.product'])->where('seller_id', $seller->id)->latest()->get();

        return view('seller.orders', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $seller = Seller::where('user_id', Auth::id())->first();
        $order = Order::where('id', $id)->where('seller_id', $seller->id)->firstOrFail();

        $request->validate([
            'status' => 'required|in:accepted,preparing,ready_for_pickup,rejected',
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
