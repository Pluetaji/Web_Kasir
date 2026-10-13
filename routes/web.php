<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Root route: Redirect based on auth and role
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }

    if (strtolower(auth()->user()->role) === 'manager') {
        return redirect('/manager');
    }

    return redirect('/kasir');
});

// Shared Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (strtolower(auth()->user()?->role) === 'manager') {
            return redirect('/manager');
        }
        return redirect('/kasir');
    })->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    // Logout Route
    Route::post('/logout', function (\App\Livewire\Actions\Logout $logout) {
        $logout();
        return redirect('/login');
    })->name('logout');
});

// Manager Protected Routes
Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager', [ManagerDashboardController::class, 'index'])->name('manager');

    // Produk
    Route::get('/manager/produk', [ProductController::class, 'index'])->name('manager.produk');
    Route::post('/manager/produk', [ProductController::class, 'store'])->name('manager.produk.store');
    Route::put('/manager/produk/{product}', [ProductController::class, 'update'])->name('manager.produk.update');
    Route::delete('/manager/produk/{product}', [ProductController::class, 'destroy'])->name('manager.produk.destroy');

    // Kategori
    Route::get('/manager/kategori', [CategoryController::class, 'index'])->name('manager.kategori');
    Route::post('/manager/kategori', [CategoryController::class, 'store'])->name('manager.kategori.store');
    Route::put('/manager/kategori/{category}', [CategoryController::class, 'update'])->name('manager.kategori.update');
    Route::delete('/manager/kategori/{category}', [CategoryController::class, 'destroy'])->name('manager.kategori.destroy');

    // Pengguna
    Route::get('/manager/pengguna', [UserController::class, 'index'])->name('manager.pengguna');
    Route::post('/manager/pengguna', [UserController::class, 'store'])->name('manager.pengguna.store');
    Route::put('/manager/pengguna/{user}', [UserController::class, 'update'])->name('manager.pengguna.update');
    Route::put('/manager/pengguna/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('pengguna.toggleStatus');
});

// Kasir Protected Routes
Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir', [CashierController::class, 'index'])->name('kasir');
    Route::post('/kasir/checkout', [CashierController::class, 'checkout'])->name('kasir.checkout');
    Route::get('/kasir/struk/{id}', [CashierController::class, 'receipt'])->name('kasir.struk');
});

require __DIR__.'/auth.php';
