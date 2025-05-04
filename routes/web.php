<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [::class, 'index']);

// Route::get('/', [HomeController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('categories/add', [CategoryController::class, 'create']);
Route::post('categories/add', [CategoryController::class, 'store']);

Route::get('categories/{id}/edit', [CategoryController::class, 'edit']);
Route::patch('categories/{id}/edit', [CategoryController::class, 'update']);
Route::delete('categories/{id}/delete', [CategoryController::class, 'destroy']);

// Product Route
Route::get('/', [ProductController::class, 'index']);
Route::get('product/add', [ProductController::class, 'create']);
Route::post('product/add', [ProductController::class, 'store']);

Route::get('product/{id}/edit', [ProductController::class, 'edit']);
Route::patch('product/{id}/edit', [ProductController::class, 'update']);
Route::delete('product/{id}/delete', [ProductController::class, 'destroy']);

// User Route
Route::get('/user', [UserController::class, 'index']);
Route::get('user/add', [UserController::class, 'create']);
Route::post('user/add', [UserController::class, 'store']);

Route::get('user/{id}/edit', [UserController::class, 'edit']);
Route::patch('user/{id}/edit', [UserController::class, 'update']);
Route::delete('user/{id}/delete', [UserController::class, 'destroy']);

Route::get('/kasir', [KasirController::class, 'index']);
Route::post('keranjang/add', [KasirController::class, 'store']);
Route::post('keranjang/tambah/{id}', [KasirController::class, 'tambah']);
Route::post('keranjang/kurang/{id}', [KasirController::class, 'kurang']);
Route::post('keranjang/hapus-semua', [KasirController::class, 'hapusSemua']);