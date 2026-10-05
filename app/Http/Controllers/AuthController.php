<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Driver;
use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLogin(): View
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user()->load('role');

            // Redirect berdasarkan role
            if ($user->role->name === 'buyer') {
                return redirect()->intended('/buyer/dashboard');
            } elseif ($user->role->name === 'seller') {
                return redirect()->intended('/seller/dashboard');
            } elseif ($user->role->name === 'driver') {
                return redirect()->intended('/driver/dashboard');
            } elseif ($user->role->name === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan Form Register
    public function showRegister(Request $request): View
    {
        $roles = Role::where('name', '!=', 'admin')->get(); // Buyer, Seller, Driver
        $selectedRole = $roles->firstWhere('name', $request->query('role'));

        return view('auth.register', compact('roles', 'selectedRole'));
    }

    // Proses Register
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'campus_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'campus_name' => $validated['campus_name'],
            'phone' => $validated['phone'] ?? null,
            'is_verified' => false,
        ]);

        $roleName = $user->role->name;

        // Jika Seller, buat data UMKM otomatis
        if ($roleName === 'seller') {
            $campus = Campus::firstOrCreate([
                'name' => $validated['campus_name'],
            ]);

            Seller::create([
                'user_id' => $user->id,
                'campus_id' => $campus->id,
                'name' => $user->name.' UMKM',
                'is_open' => false,
            ]);
        }

        // Jika Driver, buat profil driver otomatis
        if ($roleName === 'driver') {
            Driver::create([
                'user_id' => $user->id,
                'vehicle_type' => 'motor',
                'is_online' => false,
            ]);
        }

        Auth::login($user);

        if ($roleName === 'buyer') {
            return redirect('/buyer/dashboard');
        }

        if ($roleName === 'seller') {
            return redirect('/seller/dashboard');
        }

        if ($roleName === 'driver') {
            return redirect('/driver/dashboard');
        }

        return redirect('/');
    }

    // Logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
