<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $products = \App\Models\Products::all();
    return view('dashboard', compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('/dashboard', [ProductsController::class, 'actions'])->name('dashboard');
});

require __DIR__.'/auth.php';
