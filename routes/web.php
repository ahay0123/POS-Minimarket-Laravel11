<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
