<?php

use App\Http\Controllers\jogoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('jogo');
});

Route::get('/jogo-index', [jogoController::class, 'index'])->name('jogo');
Route::post('/jogo-jogar', [jogoController::class, 'jogar'])->name('jogar');