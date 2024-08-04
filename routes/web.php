<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

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

Route::prefix('admins')->group(function(){
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')
            ->middleware('admin');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')
            ->middleware('admin');
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login_form');
    Route::post('/login/owner', [AdminAuthController::class, 'login'])->name('admin.login');

});

// Route::get('/admin', function () {
//     return view('admin.index');
// })->name('index');

Route::get('/', function () {
    return view('site.index');
})->name('site.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/products')->group(function(){
    Route::get('/',[ProductController::class,"index"])->name('products.index');
    Route::get('/create',[ProductController::class,"create"])->name('products.create');
    Route::post('/',[ProductController::class,"store"])->name('products.store');
    Route::get('/{product}',[ProductController::class,"show"])->name('products.show');
    Route::get('/{product}/edit',[ProductController::class,"edit"])->name('products.edit');
    Route::put('/{product}',[ProductController::class,"update"])->name('products.update');
    Route::delete('/{product}',[ProductController::class,"destroy"])->name('products.destroy');
});

Route::prefix('/categories')->group(function(){
    Route::get('/',[CategoryController::class,"index"])->name('categories.index');
    Route::get('/create',[CategoryController::class,"create"])->name('categories.create');
    Route::post('/',[CategoryController::class,"store"])->name('categories.store');
    Route::get('/{category}',[CategoryController::class,"show"])->name('categories.show');
    Route::get('/{category}/edit',[CategoryController::class,"edit"])->name('categories.edit');
    Route::put('/{category}',[CategoryController::class,"update"])->name('categories.update');
    Route::delete('/{category}',[CategoryController::class,"destroy"])->name('categories.destroy');
});

Route::resource('brands',BrandController::class);

Route::resource('sellers',SellerController::class);
Route::patch('/sellers/{id}/toggle-status', [SellerController::class, 'toggleStatus'])->name('sellers.toggleStatus');

Route::resource('admins',AdminController::class);

