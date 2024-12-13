<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
});

Route::get('welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});


Route::middleware(['auth','isadmin'])->group(function () {
  

    Route::get('admin/dash', [DashboardController::class, 'index'])->name('admin.dash');

    Route::get('admin/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');  
    Route::post('admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');      
    Route::get('/sub-categories/{categoryId}', [ProductController::class, 'getSubCategories']);
    Route::post('/admin/product/update-toggle/{product}', [ProductController::class, 'updateToggle'])->name('admin.product.updateToggle');
    
    
    Route::get('admin/category/index', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('admin/category/{id}/updatecategory', [CategoryController::class, 'update'])->name('admin.category.updatecategory');
    Route::delete('admin/category/{id}/deletecategory', [CategoryController::class, 'destroy'])->name('admin.category.deletecategory');
    
    
    Route::get('/admin/subcategory/index', [SubcategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::get('/admin/subcategory/create', [SubcategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::get('admin/subcategory/{id}/edit', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('admin/subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::patch('admin/subcategory/{id}/update', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::delete('admin/subcategory/{id}/destroy', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
    Route::get('/admin/subcategories/{categoryId}', [SubcategoryController::class, 'getSubcategoriesByCategory']);
    Route::post('/admin/subcategory/update-toggle/{subcategoryId}', [SubcategoryController::class, 'updateToggle'])->name('admin.subcategory.updateToggle');


    Route::get('/products/add', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/add', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/{id}/editproduct', [ProductController::class, 'edit'])->name('product.edit');
Route::patch('/admin/{id}/editproduct', [ProductController::class, 'update'])->name('product.update');
Route::delete('/admin/{id}/editproduct', [ProductController::class, 'destroy'])->name('product.delete');
});
















require __DIR__.'/auth.php';
