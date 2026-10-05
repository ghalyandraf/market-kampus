<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    // Dashboard Admin & Statistik Ringkas
    public function dashboard(): View
    {
        $totalUsers = User::count();
        $totalSellers = Seller::count();
        $totalDrivers = Driver::count();
        $totalOrders = Order::count();

        $orders = Order::with(['buyer', 'seller'])->latest()->take(10)->get();
        $users = User::with('role')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalSellers', 'totalDrivers', 'totalOrders', 'orders', 'users'));
    }

    // Verifikasi Akun Seller / Driver
    public function toggleVerification(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->is_verified = ! $user->is_verified;
        $user->save();

        return back()->with('success', 'Status verifikasi user berhasil diubah!');
    }
}
