<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // Dashboard / Daftar pesanan yang tersedia untuk diantar
    public function index()
    {
        // Pesanan yang siap dijemput oleh driver
        $availableOrders = Order::with(['seller', 'buyer'])->where('status', 'ready_for_pickup')->get();

        // Pesanan yang sedang ditangani oleh driver yang sedang login
        $myDeliveries = Order::with(['seller', 'buyer'])
            ->where('driver_id', Auth::id())
            ->whereNotIn('status', ['delivered', 'cancelled'])
            ->get();

        return view('driver.dashboard', compact('availableOrders', 'myDeliveries'));
    }

    // Driver menerima order
    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'ready_for_pickup') {
            return back()->with('error', 'Pesanan tidak tersedia.');
        }

        $order->driver_id = Auth::id();
        $order->status = 'picked_up';
        $order->save();

        return back()->with('success', 'Order berhasil diambil! Segera menuju lokasi UMKM.');
    }

    // Update status pengiriman oleh driver (picked_up -> on_delivery -> delivered)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('id', $id)->where('driver_id', Auth::id())->firstOrFail();

        $request->validate([
            'status' => 'required|in:on_delivery,delivered',
            'otp_code' => 'nullable|string',
        ]);

        // Jika ingin menyelesaikan pesanan (delivered), wajib cek OTP dari buyer
        if ($request->status === 'delivered') {
            if ($order->otp_code !== $request->otp_code) {
                return back()->with('error', 'Kode OTP verifikasi salah!');
            }
        }

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pengiriman diperbarui!');
    }
}
