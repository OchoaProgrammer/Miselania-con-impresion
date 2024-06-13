<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'fecha' => 'required|date',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Crear la venta
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'fecha' => $request->fecha,
                'total' => 0, // Este valor se actualizará después
                'ganancia' => 0, // Inicializamos la ganancia en 0
            ]);

            $totalVenta = 0;
            $gananciaTotal = 0; // Inicializamos la ganancia total en 0

            // Procesar los productos
            foreach ($request->productos as $productoData) {
                $producto = Producto::find($productoData['id']);
                $cantidadVendida = $productoData['cantidad'];
                $precioVenta = $productoData['precio'];
                $preciocomprado = $producto->preciocomprado; // Obtener el costo del producto

                // Calcular subtotal
                $subtotal = $cantidadVendida * $precioVenta;

                // Calcular ganancia por cada producto
                $gananciaProducto = $cantidadVendida * ($precioVenta - $preciocomprado);

                // Agregar el subtotal al total de la venta
                $totalVenta += $subtotal;

                // Agregar la ganancia del producto a la ganancia total de la venta
                $gananciaTotal += $gananciaProducto;

                // Descontar el stock
                if ($producto->stock >= $cantidadVendida) {
                    $producto->stock -= $cantidadVendida;
                    $producto->save();

                    // Guardar el detalle de la venta
                    $venta->productos()->attach($producto->id, [
                        'cantidad' => $cantidadVendida,
                        'precio' => $precioVenta,
                    ]);
                } else {
                    DB::rollback();
                    return redirect()->back()->with('error', 'Stock insuficiente para el producto: ' . $producto->nombre);
                }
            }

            // Actualizar el total y la ganancia de la venta
            $venta->total = $totalVenta;
            $venta->ganancia = $gananciaTotal;
            $venta->save();

            DB::commit();

            return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Hubo un problema al crear la venta: ' . $e->getMessage());
        }
    }


    // Actualizar el total y la ganancia de la venta


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

        // Iterar sobre los productos para asegurar que el precio mostrado sea el precio registrado en la venta
        foreach ($productos as $producto) {
            // Revisar si hay un precio modificado registrado en la tabla pivote
            if ($producto->pivot->precio) {
                $producto->precioventa = $producto->pivot->precio; // Usar el precio registrado en la venta
            }
        }

        return view('ventas.show', compact('venta', 'productos'));
    }
}
