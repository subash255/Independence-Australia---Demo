<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
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
Route::get('admin/product/addproduct', [ProductController::class, 'create'])->name('admin.product.addproduct');
Route::get('admin/product', [ProductController::class, 'index'])->name('admin.product.product');
Route::get('/sub-categories/{categoryId}', [ProductController::class, 'getSubCategories']);




Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category.category');
Route::get('admin/category/addcategory', [CategoryController::class, 'create'])->name('admin.category.addcategory');
Route::post('admin/category/addcategory', [CategoryController::class, 'store'])->name('admin.category.addcategory');
Route::get('admin/category/{id}/editcategory', [CategoryController::class, 'edit'])->name('admin.category.editcategory');
Route::get('admin/category/{id}/editcategory', [CategoryController::class, 'edit'])->name('admin.category.editcategory');
Route::patch('admin/category/{id}/updatecategory', [CategoryController::class, 'update'])->name('admin.category.updatecategory');
Route::delete('admin/category/{id}/deletecategory', [CategoryController::class, 'destroy'])->name('admin.category.deletecategory');


Route::get('/admin/category/addsub', [SubcategoryController::class, 'create'])->name('admin.category.addsub');
Route::post('/admin/category/addsub', [SubcategoryController::class, 'store'])->name('admin.category.store');

Route::post('admin/category/store', [SubcategoryController::class, 'store'])->name('admin.category.store');









Route::get('/products/add', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/add', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/{id}/editproduct', [ProductController::class, 'edit'])->name('product.edit');
Route::patch('/admin/{id}/editproduct', [ProductController::class, 'update'])->name('product.update');
Route::delete('/admin/{id}/editproduct', [ProductController::class, 'destroy'])->name('product.delete');

require __DIR__.'/auth.php';
