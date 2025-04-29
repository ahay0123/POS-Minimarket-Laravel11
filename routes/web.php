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
Route::get('/', [CategoryController::class, 'index']);
Route::get('categories/add', [CategoryController::class, 'create']);
Route::post('categories/add', [CategoryController::class, 'store']);

Route::get('categories/{id}/edit', [CategoryController::class, 'edit']);
Route::patch('categories/{id}/edit', [CategoryController::class, 'update']);
Route::delete('categories/{id}/delete', [CategoryController::class, 'destroy']);
