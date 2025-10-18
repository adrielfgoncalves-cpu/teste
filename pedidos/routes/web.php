<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas para o controlador de clientes
Route::get('/clients/add', [App\Http\Controllers\clientController::class, 'add'])->name('client.new');
Route::get('/clients', [App\Http\Controllers\clientController::class, 'index'])->name('client.index');
Route::get('/clients/{id}/edit', [App\Http\Controllers\clientController::class, 'edit'])->name('client.edit');
Route::post('/clients', [App\Http\Controllers\clientController::class, 'store'])->name('client.store');
Route::put('/clients/{id}', [App\Http\Controllers\clientController::class, 'update'])->name('client.update');
Route::delete('/clients/{id}', [App\Http\Controllers\clientController::class, 'destroy'])->name('client.destroy');

// Rotas para o controlador de produtos
Route::get('/products/add', [App\Http\Controllers\productController::class, 'add'])->name('product.new');
Route::get('/products', [App\Http\Controllers\productController::class, 'index'])->name('product.index');
Route::get('/products/{id}/edit', [App\Http\Controllers\productController::class, 'edit'])->name('product.edit');
Route::post('/products', [App\Http\Controllers\productController::class, 'store'])->name('product.store');
Route::put('/products/{id}', [App\Http\Controllers\productController::class,    'update'])->name('product.update');
Route::delete('/products/{id}', [App\Http\Controllers\productController::class, 'destroy'])->name('product.destroy');   

// Rotas para o controlador de pedidos
Route::get('/orders', [App\Http\Controllers\orderController::class, 'index'])->name('order.index');
Route::get('/orders/add', [App\Http\Controllers\orderController::class, 'add'])->name('order.new');
Route::post('/orders', [App\Http\Controllers\orderController::class, 'store'])->name('order.store');            
