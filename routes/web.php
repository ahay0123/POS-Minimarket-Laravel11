<?php

use App\Http\Controllers\AuthControlle;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderExportController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [::class, 'index']);

// Route::get('/', [HomeController::class, 'index']);
// Route::post('/transaksi/store', [OrderController::class, 'store']);

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [AuthControlle::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthControlle::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/struk/{id}', [OrderController::class, 'showStruk']);


// Route::middleware(['auth'])->group(function () {
Route::middleware(['auth'])->group(function () {
    Route::get('/customer', [CustomersController::class, 'index']);
    Route::get('/customer/add', [CustomersController::class, 'create']);
    Route::post('/customer/add', [CustomersController::class, 'store']);

    Route::get('/customer/{id}/edit', [CustomersController::class, 'edit']);
    Route::patch('/customer/{id}/edit', [CustomersController::class, 'update']);
    Route::delete('/customer/{id}/delete', [CustomersController::class, 'destroy']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('categories/add', [CategoryController::class, 'create']);
    Route::post('categories/add', [CategoryController::class, 'store']);

    Route::get('categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::patch('categories/{id}/edit', [CategoryController::class, 'update']);
    Route::delete('categories/{id}/delete', [CategoryController::class, 'destroy']);

    Route::get('/', [ProductController::class, 'index']);
    Route::get('product/add', [ProductController::class, 'create']);
    Route::post('product/add', [ProductController::class, 'store']);

    Route::get('product/{id}/edit', [ProductController::class, 'edit']);
    Route::patch('product/{id}/edit', [ProductController::class, 'update']);
    Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);

    Route::get('/export-product', [OrderExportController::class, 'exportProduct'])->name('product.export');

    Route::get('/product/{id}/print-barcode', [ProductController::class, 'printBarcode']);


    // User Route
    Route::get('/user', [UserController::class, 'index']);
    Route::get('user/add', [UserController::class, 'create']);
    Route::post('user/add', [UserController::class, 'store']);
    Route::get('user/{id}/edit', [UserController::class, 'edit']);
    Route::patch('user/{id}/edit', [UserController::class, 'update']);
    Route::delete('user/{id}/delete', [UserController::class, 'destroy']);

    // User Table Order
    Route::delete('/order/{id}/delete', [OrderController::class, 'destroy']);
    Route::get('/order', [OrderController::class, 'index']);

    Route::get('/detail', [OrderController::class, 'indexdetail']);
    Route::delete('/detail', [OrderController::class, 'destroydetail']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData']);

    Route::get('/order-export', [OrderExportController::class, 'export'])->name('order.export');
});

// Route untuk kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir', [KasirController::class, 'index']);
    Route::post('keranjang/add', [KasirController::class, 'store']);
    Route::post('keranjang/tambah/{id}', [KasirController::class, 'tambah']);
    Route::post('keranjang/kurang/{id}', [KasirController::class, 'kurang']);
    Route::post('keranjang/hapus-semua', [KasirController::class, 'hapusSemua']);
    Route::post('transaksi/store', [OrderController::class, 'store']);
    Route::post('kasir/cek-member', [OrderController::class, 'cekMember']);

    Route::post('/keranjang/add-by-barcode', [KasirController::class, 'addByBarcode']);
});

// });
