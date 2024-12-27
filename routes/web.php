<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PunchOutController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ManageuserController;
use App\Http\Controllers\NayaController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TextController;
use App\Http\Middleware\AdminMiddleware;

use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;


Route::get('checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('user/cart/show', [CheckoutController::class, 'show'])->name('user.cart.show');

Route::get('menu/{id?}/index', [HomepageController::class, 'showcat'])->name('menu.index');


// Route::get('/product', [HomepageController::class, 'showproducts']);
Route::get('/product/{id}', [HomepageController::class, 'showproduct'])->name('product.show');

Route::get('/naya', [NayaController::class, 'index']);


Route::get('/', [HomepageController::class, 'welcome'])->name('welcome');
Route::get('/homepage', [HomepageController::class, 'homepage'])->name('homepage');

//Fake Store API
Route::get('/fetch-test', [TestController::class, 'fetchAndStore']);
Route::get('/test', [TestController::class, 'showTests']);

Route::get('/scrape-products', [ScraperController::class, 'scrapeProducts']);

Route::get('/punchout', [PunchOutController::class, 'fetchCatalog']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'isadmin'])->group(function () {
    //Admin routes
    Route::get('admin/dash', [DashboardController::class, 'index'])->name('admin.dash');
    Route::resource('admin', AdminController::class)->except(['show']);

    //SuperAdmin routes
    Route::get('admin/admin/index', [AdminController::class, 'index'])->name('admin.admin.index');
    // Route::get('admin/admin/create', [AdminController::class, 'create'])->name('admin.admin.create');
    Route::post('admin/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::get('admin/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::patch('admin/admin/{user}/update', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('admin/admin/{user}/destroy', [AdminController::class, 'destroy'])->name('admin.admin.destroy');
    
    //Product routes
    Route::get('admin/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    // Route::get('admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');
    Route::get('/sub-categories/{categoryId}', [ProductController::class, 'getSubCategories']);
    Route::post('/admin/product/update-toggle/{product}', [ProductController::class, 'updateToggle'])->name('admin.product.updateToggle');
    Route::post('/admin/product/update-status/{id}', [ProductController::class, 'updateStatus'])->name('admin.product.update-status');
 

    //Category routes
    Route::get('admin/category/index', [CategoryController::class, 'index'])->name('admin.category.index');
    // Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('admin/category/{id}/updatecategory', [CategoryController::class, 'update'])->name('admin.category.updatecategory');
    Route::delete('admin/category/{id}/deletecategory', [CategoryController::class, 'destroy'])->name('admin.category.deletecategory');

    //Subcategory routes
    Route::get('/admin/subcategory/index', [SubcategoryController::class, 'index'])->name('admin.subcategory.index');
    // Route::get('/admin/subcategory/create', [SubcategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::get('admin/subcategory/{id}/edit', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('admin/subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::patch('admin/subcategory/{id}/update', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::delete('admin/subcategory/{id}/destroy', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
    Route::get('/admin/subcategories/{categoryId}', [SubcategoryController::class, 'getSubcategoriesByCategory']);
    Route::post('/admin/subcategory/update-toggle/{subcategoryId}', [SubcategoryController::class, 'updateToggle'])->name('admin.subcategory.updateToggle');



    //Brand routes
    Route::get('admin/brand/index', [BrandController::class, 'index'])->name('admin.brand.index');
    // Route::get('/brand/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::patch('/brand/{id}/update', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store'); 
    Route::delete('/brand/{id}/destroy', [BrandController::class, 'destroy'])->name('admin.brand.destroy');

    Route::get('admin/logos/index', [LogoController::class, 'index'])->name('admin.logos.index');
    Route::get('admin/logos/create', [LogoController::class, 'create'])->name('admin.logos.create');
    Route::post('admin/logos/store', [LogoController::class, 'store'])->name('admin.logos.store');
    Route::get('admin/logos/{id}/edit', [LogoController::class, 'edit'])->name('admin.logos.edit');
    Route::patch('admin/logos/{id}/update', [LogoController::class, 'update'])->name('admin.logos.update');
    Route::delete('admin/logos/{id}/destroy', [LogoController::class, 'destroy'])->name('admin.logos.destroy');
    // Route::resource('logos', LogoController::class);

    //Image routes
    Route::get('admin/banner/index', [BannerController::class, 'index'])->name('admin.banner.index');
    Route::post('admin/banner/store', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::get('admin/banner/{id}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::patch('admin/banner/{id}/update', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::delete('admin/banner/{id}/destroy', [BannerController::class, 'destroy'])->name('admin.banner.destroy');

    // Manage Text routes
    Route::get('admin/text/index', [TextController::class, 'index'])->name('admin.text.index');
    Route::get('admin/text/create', [TextController::class, 'create'])->name('admin.text.create');
    Route::post('admin/text/store', [TextController::class, 'store'])->name('admin.text.store');
    Route::get('admin/text/{id}/edit', [TextController::class, 'edit'])->name('admin.text.edit');
    Route::patch('admin/text/{id}/update', [TextController::class, 'update'])->name('admin.text.update');
    Route::delete('admin/text/{id}/destroy', [TextController::class, 'destroy'])->name('admin.text.destroy');

    


});

Route::middleware('auth')->group(function() {

    Route::get('user/welcome', [HomepageController::class, 'index'])->name('user.welcome');

Route::get('user/contact/index', [ContactController::class, 'index'])->name('user.contact.index');
Route::post('user/contact/store', [ContactController::class, 'store'])->name('user.contact.store'); 


Route::get('user/manageuser/index', [ManageuserController::class, 'index'])->name('user.manageuser.index');
Route::get('user/manageuser/create', [ManageuserController::class, 'create'])->name('user.manageuser.create');
Route::post('user/manageuser/store', [ManageuserController::class, 'store'])->name('user.manageuser.store'); 

Route::get('/impersonate/{id}', [HomepageController::class, 'impersonate'])->name('impersonate');


Route::post('/cart/{productId}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('user/cart/index', [CartController::class, 'viewCart'])->name('user.cart.index');
    Route::post('/cart/update/{cartId}', [CartController::class, 'updateQuantity'])->name('user.cart.update');



});













require __DIR__ . '/auth.php';
