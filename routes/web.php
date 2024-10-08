<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Site\ShopController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Seller\SellerAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ################################ Admin Routes ######################### //

Route::prefix('admins')->group(function(){
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')
            ->middleware('admin');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')
            ->middleware('admin');
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login_form');
    Route::post('/login/owner', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::prefix('admins/orders')->group(function(){
    Route::get('/',[AdminOrderController::class,"index"])->name('orders.index');
    Route::get('/{order}',[AdminOrderController::class,"show"])->name('orders.show');
    Route::delete('/{order}',[AdminOrderController::class,"destroy"])->name('orders.destroy');
});

Route::resource('admins',AdminController::class);

Route::resource('brands',BrandController::class);

Route::prefix('/categories')->group(function(){
    Route::get('/',[CategoryController::class,"index"])->name('categories.index');
    Route::get('/create',[CategoryController::class,"create"])->name('categories.create');
    Route::post('/',[CategoryController::class,"store"])->name('categories.store');
    Route::get('/{category}',[CategoryController::class,"show"])->name('categories.show');
    Route::get('/{category}/edit',[CategoryController::class,"edit"])->name('categories.edit');
    Route::put('/{category}',[CategoryController::class,"update"])->name('categories.update');
    Route::delete('/{category}',[CategoryController::class,"destroy"])->name('categories.destroy');
});

Route::resource('coupons', CouponController::class);


// ################################ End Admin Routes ######################### //



// ################################ Seller Routes ######################### //
Route::prefix('sellers')->group(function(){
    Route::get('/dashboard', [SellerAuthController::class, 'dashboard'])->name('seller.dashboard')
            ->middleware('seller');
    Route::get('/logout', [SellerAuthController::class, 'logout'])->name('seller.logout')
            ->middleware('seller');
    Route::get('/login', [SellerAuthController::class, 'index'])->name('seller_login_form');
    Route::post('/login/owner', [SellerAuthController::class, 'login'])->name('seller.login');

});

// ################################ End Seller Routes ######################### //



// ################################ User Routes ######################### //
Route::get('/', function () {
    return view('site.index');
})->name('site.index')->middleware('auth','verified');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ################################ End User Routes ######################### //

Route::prefix('/products')->group(function(){
    Route::get('/',[ProductController::class,"index"])->name('products.index');
    Route::get('/create',[ProductController::class,"create"])->name('products.create');
    Route::post('/',[ProductController::class,"store"])->name('products.store');
    Route::get('/{product}',[ProductController::class,"show"])->name('products.show');
    Route::get('/{product}/edit',[ProductController::class,"edit"])->name('products.edit');
    Route::put('/{product}',[ProductController::class,"update"])->name('products.update');
    Route::delete('/{product}',[ProductController::class,"destroy"])->name('products.destroy');
});


Route::resource('sellers',SellerController::class);
Route::patch('/sellers/{id}/toggle-status', [SellerController::class, 'toggleStatus'])->name('sellers.toggleStatus');


Route::get('/shop', [ShopController::class, 'index'])->name('site.shop');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

Route::get('/wishlist',[WishlistController::class,'getWishlistedProducts'])->name('wishlist.index');
Route::post('/wishlist/store', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');
Route::delete('/wishlist/remove',[WishlistController::class,'removeProductFromWishlist'])->name('wishlist.remove');
Route::post('/wishlist/move-to-cart',[WishlistController::class,'moveToCart'])->name('wishlist.move.to.cart');

Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');
Route::post('/orders/applyCoupon', [OrderController::class, 'applyCoupon'])->name('orders.applyCoupon')->middleware('auth');
Route::post('/orders/calculateShipping', [OrderController::class, 'calculateShipping'])->name('orders.calculateShipping')->middleware('auth');


Route::get('/payment/success/{order}', [PaymentController::class ,'success'])->name('payment.success');
Route::get('/payment/failed/{order}', [PaymentController::class ,'failed'])->name('payment.failed');






Route::get('/sendEmail',[EmailController::class,'send']);

