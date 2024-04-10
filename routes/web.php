<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [LandingController::class, 'index']);
Route::get('/shop', [LandingController::class, 'shop']);
Route::get('/category-shop/{id}', [LandingController::class, 'category_shop'])->name('category-shop');
Route::get('/product-detail/{id}', [LandingController::class, 'product_detail'])->name('product-detail');
Route::get('/blogs', [LandingController::class, 'blogs']);
Route::get('/contact', [LandingController::class, 'contact']);
Route::get('/blog-detail/{id}', [LandingController::class, 'blog_detail'])->name('blog-detail');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('voucher', VoucherController::class);
    Route::resource('blog', BlogController::class);
    Route::get('/order', [OrderController::class, 'order'])->name('order');
});

Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::post('/add-cart', [CartController::class, 'add'])->name('add-cart');
    Route::get('/add-cart-1', [CartController::class, 'add'])->name('add-cart-1');
    Route::delete('/clear-cart', [CartController::class, 'clear'])->name('clear-cart');
    Route::delete('/delete-cart/{id}', [CartController::class, 'delete'])->name('delete-cart');
    Route::put('/update-cart/{id}', [CartController::class, 'update'])->name('update-cart');
    Route::get('/cart', [LandingController::class, 'cart']);
    Route::get('/checkout', [OrderController::class, 'index']);
    Route::post('/voucher', [OrderController::class, 'voucher'])->name('voucher');
    Route::post('/voucher-destroy', [OrderController::class, 'voucher_destroy'])->name('voucher-destroy');
    Route::resource('customer-address', CustomerAddressController::class);
    Route::post('/checkout-process', [OrderController::class, 'checkout_process'])->name('checkout-process');
    Route::get('/order-lists', [OrderController::class, 'list_order'])->name('order-lists');
    Route::get('/order-history', [OrderController::class, 'history_order'])->name('order-history');
});

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
