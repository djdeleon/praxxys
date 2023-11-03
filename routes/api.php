<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/products', [ProductController::class, 'search'])->name('products.search');
Route::post('/products/create', [ProductController::class, 'store'])->name('products.create');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('products/edit/{id}', [ProductController::class, 'show'])->name('products.show');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->name('products.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
