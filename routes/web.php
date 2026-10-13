<?php

use App\Http\Controllers\CategoryController;
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
    Route::get('/manager', function () {
        return view('dashboardmanajer');
    })->name('manager');

    Route::get('/manager/produk', function () {
        return view('daftarproduk');
    })->name('manager.produk');

    Route::get('/manager/kategori', [CategoryController::class, 'index'])->name('manager.kategori');
    Route::post('/manager/kategori', [CategoryController::class, 'store'])->name('manager.kategori.store');
    Route::put('/manager/kategori/{category}', [CategoryController::class, 'update'])->name('manager.kategori.update');
    Route::delete('/manager/kategori/{category}', [CategoryController::class, 'destroy'])->name('manager.kategori.destroy');

    Route::get('/manager/pengguna', function () {
        return view('pengguna');
    })->name('manager.pengguna');

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
