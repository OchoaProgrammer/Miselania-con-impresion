<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/clientes',[ClienteController::class, 'index']);
Route::post('/clientes',[ClienteController::class,'store'])->name('clientes.store');
Route::get('/clientes/create',[ClienteController::class,'create'])->name('clientes.create');
Route::get('/clientes/{id}',[ClienteController::class,'show'])->name('clientes.show');
