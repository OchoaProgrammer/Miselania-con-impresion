<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener los datos para el dashboard
        $totalClientes = Cliente::count();
        $totalProductos = Producto::count();
        $totalVentas = Venta::count();
        $totalCategorias = Categoria::count();

        // Calcular el total de ventas
        $ventasTotales = Venta::sum('total');

        // Calcular las ganancias mensuales
        $gananciasMensuales = Venta::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(ganancia) as total')
        )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Consulta para calcular las inversiones mensuales acumuladas
        $inversionesMensuales = DB::table('productos')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(preciocomprado * stock) as total_inversiones')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Calcular la inversión total acumulada
        $inversionTotal = Producto::sum(DB::raw('preciocomprado * stock'));

        // Preparar los datos para el gráfico de ganancias mensuales
        $labels = $gananciasMensuales->map(function ($item) {
            return date("F Y", mktime(0, 0, 0, $item->month, 1, $item->year)); // Formato Mes Año
        });

        $gananciasData = $gananciasMensuales->pluck('total');
        $inversionesData = $inversionesMensuales->pluck('total_inversiones');

        // Pasar los datos a la vista
        return view('home', compact('totalClientes', 'totalProductos', 'totalVentas', 'totalCategorias', 'ventasTotales', 'labels', 'gananciasData', 'inversionesData', 'inversionTotal'));
    }
}
