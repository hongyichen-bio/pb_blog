<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;


Route::get('/', [PageController::class, 'home']);
Route::get('/pb', [PageController::class, 'pb']);
Route::get('/download/{id}', [PageController::class, 'download'])
->where('id', '[0-9]+');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});


Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);

Route::patch('/cart/cookie', [CartController::class, 'updateCookie'])->name('cart.cookie.update');
Route::delete('/cart/cookie', [CartController::class, 'deleteCookie'])->name('cart.cookie.delete');
Route::resource('cart', CartController::class);


