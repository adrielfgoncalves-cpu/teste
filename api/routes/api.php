<?php

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

//rotas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rotas da API
//rotas de clientes, reuqer autenticação, exceto para store
Route::apiResource('clients', ClientController::class);

//rotas de produtos, reuqer autenticação, exceto para store
Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');



//rota index requer autenticação
//Route::get('products', ProductController::class.'@index')->middleware('auth');
//rota show requer autenticação
//Route::get('products/{id}', ProductController::class.'@show')->middleware('auth');

