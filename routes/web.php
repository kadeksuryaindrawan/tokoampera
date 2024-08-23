<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAddressController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Livewire\YearSort;
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

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);;
    return redirect()->back();
})->name('locale');

Route::get('/', [LandingController::class, 'index']);
Route::get('/shop', [LandingController::class, 'shop']);
Route::get('/category-shop/{id}', [LandingController::class, 'category_shop'])->name('category-shop');
Route::get('/product-detail/{id}', [LandingController::class, 'product_detail'])->name('product-detail');
// Route::get('/blogs', [LandingController::class, 'blogs']);
Route::get('/contact', [LandingController::class, 'contact']);
// Route::get('/blog-detail/{id}', [LandingController::class, 'blog_detail'])->name('blog-detail');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('/export-all-product', [ProductController::class, 'export_all_pdf'])->name('export-all-product');
    Route::resource('vouchers', VoucherController::class);
    // Route::resource('blog', BlogController::class);
    Route::get('/order', [OrderController::class, 'order'])->name('order');
    Route::post('/add-shipping', [OrderController::class, 'add_shipping'])->name('add-shipping');
    Route::get('/pay-detail/{id}', [OrderController::class, 'pay_detail'])->name('pay-detail');
    Route::get('/pay-accept/{id}', [OrderController::class, 'pay_accept'])->name('pay-accept');
    Route::put('/pay-reject/{id}', [OrderController::class, 'pay_reject'])->name('pay-reject');
    Route::post('/add-resi', [OrderController::class, 'add_resi'])->name('add-resi');
    Route::delete('/order-delete/{id}', [OrderController::class, 'order_delete'])->name('order-delete');
    Route::get('/order-success', [OrderController::class, 'order_success'])->name('order-success');
    // Route::get('/pos', [POSController::class, 'index'])->name('pos');
    // Route::get('/pos-history', [POSController::class, 'pos_history'])->name('pos-history');
    // Route::get('/invoice-detail/{id}', [POSController::class, 'invoice_detail'])->name('invoice-detail');
    // Route::get('/export-pdf-invoice/{id}', [POSController::class, 'exportPdfInvoice'])->name('export-pdf-invoice');
    Route::get('/export-excel-penjualan-tahun/{year}', [OrderController::class, 'exportExcelTahun'])->name('export-excel-penjualan-tahun');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan-all');
    Route::get('/laporan/filter', [LaporanController::class, 'daftar_filter_laporan'])->name('filter-laporan');
    Route::get('/export-all-pdf', [LaporanController::class, 'export_all_pdf'])->name('export-all-pdf');
    Route::get('/export-filter-pdf', [LaporanController::class, 'export_filter_pdf'])->name('export-filter-pdf');
});

Route::get('/order-detail/{id}', [OrderController::class, 'order_detail'])->name('order-detail')->middleware('auth');
Route::post('/add-cart', [CartController::class, 'add'])->name('add-cart')->middleware('auth');
Route::delete('/clear-cart', [CartController::class, 'clear'])->name('clear-cart')->middleware('auth');
Route::delete('/delete-cart/{id}', [CartController::class, 'delete'])->name('delete-cart')->middleware('auth');
Route::put('/update-cart/{id}', [CartController::class, 'update'])->name('update-cart')->middleware('auth');
Route::post('/voucher', [OrderController::class, 'voucher'])->name('voucher')->middleware('auth');
Route::post('/voucher-destroy', [OrderController::class, 'voucher_destroy'])->name('voucher-destroy')->middleware('auth');
Route::post('/checkout-process', [OrderController::class, 'checkout_process'])->name('checkout-process')->middleware('auth');

Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/add-cart-1', [CartController::class, 'add'])->name('add-cart-1');
    Route::get('/cart', [LandingController::class, 'cart']);
    Route::get('/checkout', [OrderController::class, 'index']);
    Route::resource('customer-address', CustomerAddressController::class);
    Route::get('/order-lists', [OrderController::class, 'list_order'])->name('order-lists');
    Route::get('/pay/{id}', [OrderController::class, 'pay'])->name('pay');
    Route::put('/pay-process/{id}', [OrderController::class, 'pay_process'])->name('pay-process');
    Route::get('/order-history', [OrderController::class, 'history_order'])->name('order-history');
    Route::get('/order-acc/{id}', [OrderController::class, 'order_acc'])->name('order-acc');
    Route::put('/acc-process', [OrderController::class, 'acc_process'])->name('acc-process');
});

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
