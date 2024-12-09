<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
});


Route::get('/checkout', function () {
    return view('checkout');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dash', [DashboardController::class, 'index'])->name('admin.dash');
Route::get('admin/product', [ProductController::class, 'create'])->name('admin.product');
Route::get('admin/product', [ProductController::class, 'index'])->name('admin.product.product');

Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category.category');


Route::get('/products/add', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/add', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/{id}/editproduct', [ProductController::class, 'edit'])->name('product.edit');
Route::patch('/admin/{id}/editproduct', [ProductController::class, 'update'])->name('product.update');
Route::delete('/admin/{id}/editproduct', [ProductController::class, 'destroy'])->name('product.delete');

require __DIR__.'/auth.php';
