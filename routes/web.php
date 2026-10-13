<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    // Role-aware default dashboard route
    Route::get('/dashboard', function () {
        if (auth()->user()?->role === 'kasir') {
            return redirect('/kasir');
        }
        return redirect('/manager');
    })->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    // Manager / Admin Routes
    Route::get('/manager', [ManagerDashboardController::class, 'index'])->name('manager');

    Route::get('/manager/produk', [ProductController::class, 'index'])->name('manager.produk');
    Route::post('/manager/produk', [ProductController::class, 'store'])->name('manager.produk.store');
    Route::put('/manager/produk/{product}', [ProductController::class, 'update'])->name('manager.produk.update');
    Route::delete('/manager/produk/{product}', [ProductController::class, 'destroy'])->name('manager.produk.destroy');

    Route::get('/manager/kategori', [CategoryController::class, 'index'])->name('manager.kategori');
    Route::post('/manager/kategori', [CategoryController::class, 'store'])->name('manager.kategori.store');
    Route::put('/manager/kategori/{category}', [CategoryController::class, 'update'])->name('manager.kategori.update');
    Route::delete('/manager/kategori/{category}', [CategoryController::class, 'destroy'])->name('manager.kategori.destroy');

    Route::get('/manager/pengguna', [UserController::class, 'index'])->name('manager.pengguna');
    Route::post('/manager/pengguna', [UserController::class, 'store'])->name('manager.pengguna.store');
    Route::put('/manager/pengguna/{user}', [UserController::class, 'update'])->name('manager.pengguna.update');
    Route::put('/manager/pengguna/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('pengguna.toggleStatus');

    // Kasir Route
    Route::get('/kasir', function () {
        return view('kasir');
    })->name('kasir');

    // Logout Route
    Route::post('/logout', function (\App\Livewire\Actions\Logout $logout) {
        $logout();
        return redirect('/login');
    })->name('logout');
});

require __DIR__.'/auth.php';
