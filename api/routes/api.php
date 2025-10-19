<?php

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

//Rotas da API
//rotas de clientes
Route::apiResource('clients', \App\Http\Controllers\ClientController::class);

//rotas de produtos
Route::apiResource('products', \App\Http\Controllers\ProductController::class);
