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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ManageuserController;
use App\Http\Controllers\NayaController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TextController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('user/cart/show', [CheckoutController::class, 'show'])->name('user.cart.show');

Route::get('category/{slug}', [HomepageController::class, 'showcat'])->name('menu.index');
Route::get('products', [HomepageController::class, 'allproduct'])->name('product.index');

//newsletter submission
Route::post('newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');



// Route::get('/product', [HomepageController::class, 'showproducts']);
Route::get('/product/{id}', [HomepageController::class, 'showproduct'])->name('product.show');



//review routes
Route::post('review', [ReviewController::class, 'store'])->name('review.store');
Route::get('review/{id}', [ReviewController::class, 'index'])->name('review.index');


Route::get('/', [HomepageController::class, 'welcome'])->name('welcome');
Route::get('/homepage', [HomepageController::class, 'homepage'])->name('homepage');



Route::get('/search/welcome', [HomepageController::class, 'search'])->name('search.products');


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
    Route::post('admin/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::get('admin/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::patch('admin/admin/{user}/update', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::delete('admin/admin/{user}/destroy', [AdminController::class, 'destroy'])->name('admin.admin.destroy');

    //Product routes
    Route::get('admin/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    Route::post('admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::delete('admin/product/{id}/destroy', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/admin/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');
    Route::get('/sub-categories/{categoryId}', [ProductController::class, 'getSubCategories']);
    Route::post('admin/product/update-toggle/{productId}', [ProductController::class, 'updateToggleStatus']);


    //Category routes
    Route::get('admin/category/index', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/{slug}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('admin/category/{id}/updatecategory', [CategoryController::class, 'update'])->name('admin.category.updatecategory');
    Route::delete('admin/category/{id}/deletecategory', [CategoryController::class, 'destroy'])->name('admin.category.deletecategory');
    Route::post('admin/category/update-toggle/{categoryId}', [CategoryController::class, 'updateToggleStatus']);

    //Subcategory routes
    Route::get('/admin/subcategory/{id}/index', [SubcategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::get('admin/subcategory/{id}/edit', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::post('admin/subcategory/store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');
    Route::patch('admin/subcategory/{id}/update', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::delete('admin/subcategory/{id}/destroy', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.destroy');
    Route::get('/admin/subcategories/{categoryId}', [SubcategoryController::class, 'getSubcategoriesByCategory']);
    Route::post('/admin/subcategory/update-toggle/{subcategoryId}', [SubcategoryController::class, 'updateToggle'])->name('admin.subcategory.updateToggle');



    //Brand routes
    Route::get('admin/brand/index', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::get('/brand/{id}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::patch('/brand/{id}/update', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
    Route::delete('/brand/{id}/destroy', [BrandController::class, 'destroy'])->name('admin.brand.destroy');

    //Order routes
    Route::get('admin/order/index', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/view/{id}', [OrderController::class, 'view'])->name('admin.order.view');
    Route::delete('admin/order/{id}/destroy', [OrderController::class, 'destroy'])->name('admin.order.destroy');


    //Banner routes
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

    //Newsletter routes
    Route::get('admin/newsletter/index', [NewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('admin/newsletter/subscribers', [NewsletterController::class, 'subscribers'])->name('admin.newsletter.subscribers');
    Route::delete('admin/newsletter/{id}/destroy', [NewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::post('admin/newsletter/send', [NewsletterController::class, 'sendNewsletter'])->name('admin.newsletter.send.post');
    

    //Review routes
    Route::get('admin/reviews/index', [ReviewController::class, 'adminindex'])->name('admin.reviews.index');
    Route::delete('admin/reviews/{id}/destroy', [ReviewController::class, 'destroy'])->name('admin.review.destroy');
    Route::post('admin/review/update-toggle/{reviewId}', [ReviewController::class, 'updateToggleStatus']);

});

Route::middleware('auth')->group(function () {

    Route::get('user/welcome', [HomepageController::class, 'index'])->name('user.welcome');

    //Contact routes
    Route::get('user/contact/index', [ContactController::class, 'index'])->name('user.contact.index');
    Route::post('user/contact/store', [ContactController::class, 'store'])->name('user.contact.store');
    Route::get('user/contact/address', [ContactController::class, 'address'])->name('user.contact.address');

    Route::patch('/user/{user}', [ProfileController::class, 'update'])->name('user.update');
Route::get('/user/{user}/edit', [ProfileController::class, 'edit'])->name('user.edit');

    //My Order
    Route::get('user/myorder', [HomepageController::class, 'order'])->name('user.myorder');

    //Manage User
    Route::get('user/manageuser/index', [ManageuserController::class, 'index'])->name('user.manageuser.index');
    Route::get('user/manageuser/create', [ManageuserController::class, 'create'])->name('user.manageuser.create');
    Route::post('user/manageuser/store', [ManageuserController::class, 'store'])->name('user.manageuser.store');
    Route::get('user/manageuser/{user}/edit', [ManageuserController::class, 'edit'])->name('user.manageuser.edit');
    Route::patch('user/manageuser/{user}/update', [ManageuserController::class, 'update'])->name('user.manageuser.update');
    

    //Switch User
    Route::get('/impersonate/{id}', [HomepageController::class, 'impersonate'])->name('impersonate');
    Route::post('/stop-impersonating', [HomepageController::class, 'stopImpersonation'])->name('stop.impersonation');

    //Cart routes
    Route::post('/cart/{productId}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('user/cart/index', [CartController::class, 'viewCart'])->name('user.cart.index');
    Route::patch('/cart/update/{cartId}', [CartController::class, 'updateQuantity'])->name('user.cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');
});













require __DIR__ . '/auth.php';
