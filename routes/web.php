<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/clientes',[ClienteController::class, 'index'])->name('clientes.index');
Route::post('/cliente',[ClienteController::class,'store'])->name('cliente.store');
Route::get('/cliente/create',[ClienteController::class,'create'])->name('cliente.create');
Route::get('/cliente/{id}',[ClienteController::class,'show'])->name('cliente.show');

Route::get('/productos',[ProductoController::class, 'index'])->name('productos.index');
Route::post('/producto',[ProductoController::class,'store'])->name('producto.store');
Route::get('/producto/create',[ProductoController::class,'create'])->name('producto.create');
Route::get('/productos/{id}/edit', [ProductoController::class,'edit'])->name('productos.edit');
Route::post('/productos/{id}/agregar-cantidad', [ProductoController::class, 'agregarCantidad'])->name('productos.agregar_cantidad');
Route::put('/productos/{id}', [ProductoController::class,'update'])->name('productos.update');




Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');




Route::resource('ventas', VentaController::class)->except(['edit', 'update']);
Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
Route::get('/ventas/{id}', [VentaController::class,'show'])->name('ventas.show');
Route::get('/productos-por-categoria/{categoria}', [VentaController::class, 'productosPorCategoria'])->name('productos.por.categoria');
Route::get('/stock-producto/{producto}', [VentaController::class, 'stockProducto'])->name('stock.producto');

// routes/web.php












