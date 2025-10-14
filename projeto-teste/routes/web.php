<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas para UserController
Route::get('/create-user', [App\Http\Controllers\userController::class, 'create'])->name('user.create');
Route::post('/add-user', [App\Http\Controllers\userController::class, 'add'])->name('user.add');
Route::get('/list-user', [App\Http\Controllers\userController::class, 'list'])->name('user.list');
Route::get('/view-user/{id}', [App\Http\Controllers\userController::class, 'view'])->name('user.view');
