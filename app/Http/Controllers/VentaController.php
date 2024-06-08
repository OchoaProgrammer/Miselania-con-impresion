<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $categorias = Categoria::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'total' => $request->total,
            'fecha' => $request->fecha,
        ]);

        if ($request->has('productos')) {
            foreach ($request->productos as $producto) {
                if (isset($producto['id']) && isset($producto['cantidad'])) {
                    $venta->productos()->attach($producto['id'], [
                        'cantidad' => $producto['cantidad'],
                        'precio' => Producto::find($producto['id'])->precioventa,
                    ]);
                }
            }
        }

        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }




    public function productosPorCategoria($categoria)
    {
        $categoria = Categoria::findOrFail($categoria);
        $productos = $categoria->productos;
        return response()->json($productos);
    }

    public function stockProducto(Producto $producto)
    {
        return response()->json(['stock' => $producto->stock, 'precioventa' => $producto->precioventa]);
    }

    public function show($id)
    {
        $venta = Venta::findOrFail($id);
        $productos = $venta->productos()->withPivot('cantidad', 'precio')->get();
        return view('ventas.show', compact('venta', 'productos'));
    }
}
