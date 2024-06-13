<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $producto = new Producto();
        return view('productos.create', compact('categorias','producto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->preciocomprado = $request->preciocomprado;
        $producto->precioventa = $request->precioventa;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();
        return redirect()->route('productos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->preciocomprado = $request->preciocomprado;
        $producto->precioventa = $request->precioventa;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }
    public function agregarCantidad(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cantidadNueva = $request->stock;

        // Actualizar stock del producto
        $producto->stock += $cantidadNueva;
        $producto->save();

        // Recalcular la inversión total después de actualizar el stock
        $inversionTotal = Producto::sum(DB::raw('preciocomprado * stock'));

        // Redireccionar de vuelta con mensaje de éxito
        return redirect()->back()->with('success', 'Cantidad agregada correctamente.');
    }
}


