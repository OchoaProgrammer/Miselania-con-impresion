<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/clientes',[ClienteController::class, 'index'])->name('clientes.index');
Route::post('/cliente',[ClienteController::class,'store'])->name('cliente.store');
Route::get('/cliente/create',[ClienteController::class,'create'])->name('cliente.create');
Route::get('/cliente/{id}',[ClienteController::class,'show'])->name('cliente.show');

Route::get('/productos',[ProductoController::class, 'index'])->name('productos.index');
Route::post('/producto',[ProductoController::class,'store'])->name('producto.store');
Route::get('/producto/create',[ProductoController::class,'create'])->name('producto.create');
