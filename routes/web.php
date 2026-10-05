<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes
fn () => null; // placeholder group
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Dashboards (Contoh Sederhana)
Route::middleware(['auth'])->group(function () {
    Route::get('/buyer/dashboard', fn () => view('buyer.dashboard'))->name('buyer.dashboard');
    Route::get('/seller/dashboard', fn () => view('seller.dashboard'))->name('seller.dashboard');
    Route::get('/driver/dashboard', fn () => view('driver.dashboard'))->name('driver.dashboard');
    Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
});

// Buyer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/buyer/dashboard', [BuyerController::class, 'index'])->name('buyer.dashboard');
    Route::post('/buyer/cart/add', [BuyerController::class, 'addToCart'])->name('buyer.cart.add');
    Route::get('/buyer/cart', [BuyerController::class, 'cartIndex'])->name('buyer.cart');
    Route::delete('/buyer/cart/{id}', [BuyerController::class, 'removeCartItem'])->name('buyer.cart.remove');
    Route::post('/buyer/checkout', [BuyerController::class, 'checkout'])->name('buyer.checkout');
    Route::get('/buyer/orders', [BuyerController::class, 'ordersIndex'])->name('buyer.orders');
});

// Seller Order Management
Route::middleware(['auth'])->group(function () {
    Route::get('/seller/products', [SellerProductController::class, 'index'])->name('seller.products.index');
    Route::post('/seller/products', [SellerProductController::class, 'store'])->name('seller.products.store');
    Route::delete('/seller/products/{id}', [SellerProductController::class, 'destroy'])->name('seller.products.destroy');
    Route::get('/seller/orders', [SellerOrderController::class, 'index'])->name('seller.orders');
    Route::put('/seller/orders/{id}/status', [SellerOrderController::class, 'updateStatus'])->name('seller.orders.update');

    // Driver Routes
    Route::get('/driver/dashboard', [DriverController::class, 'index'])->name('driver.dashboard');
    Route::post('/driver/orders/{id}/accept', [DriverController::class, 'acceptOrder'])->name('driver.orders.accept');
    Route::put('/driver/orders/{id}/status', [DriverController::class, 'updateStatus'])->name('driver.orders.update');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/admin/users/{id}/verify', [AdminController::class, 'toggleVerification'])->name('admin.users.verify');
});
