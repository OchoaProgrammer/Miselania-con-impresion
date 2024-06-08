@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<br>
<br>
<br>
<br>
<style>
    body {
        background: linear-gradient(to right, #004ff8, #a4cee2);
        color: whitesmoke;
        font-family: Arial, sans-serif;
    }

    /* Estilo para los botones de acción */
    .btn-container {
        display: flex;
    }

    .btn-action {
        margin-right: 5px;
        /* Ajusta el margen entre los botones de acción */
    }
</style>
<div class="container">
    <h1 style="color: white">Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-success">Crear Venta</a>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                <td>{{ $venta->total }}</td>
                <td>
                    <div class="btn-container">
                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-primary btn-action">Ver</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
