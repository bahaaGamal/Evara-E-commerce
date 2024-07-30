<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;

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

Route::get('/', function () {
    return view('index');
})->name('index');

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

