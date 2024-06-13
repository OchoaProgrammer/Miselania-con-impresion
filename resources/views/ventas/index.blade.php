@extends('layouts.app')

@section('title', 'Ventas')

@section('content')

<style>
    body {
        background: linear-gradient(to right, #004ff8, #a4cee2);
        color: whitesmoke;
        font-family: Arial, sans-serif;
    }


    </style>
    <br>
<div class="container">
    <h1>Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-success">Crear Venta</a>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Ganancia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                <td>{{ (int)$venta->total }}</td>
                <td>{{ (int)$venta->ganancia }}</td> <!-- Mostrar la ganancia como número entero -->
                <td>
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-primary">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
