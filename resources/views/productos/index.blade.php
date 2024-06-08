@extends('layouts.app')

@section('title', 'Dashboard')

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
    margin-right: 5px; /* Ajusta el margen entre los botones de acción */
}

/* Estilo para el modal */
.modal-title {
    color: black;
}
</style>
<div class="container">
    <h1 style="color: white">Productos</h1>
    <form action="{{ route( 'producto.create' ) }}" method="get">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Precio de Compra</th>
                    <th scope="col">Precio de Venta</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->preciocomprado }}</td>
                    <td>{{ $producto->precioventa }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>
                        <div class="btn-container">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm btn-action">Editar</a>
                            <form action="{{ route('productos.agregar_cantidad', $producto->id) }}" method="POST">
                                <button type="button" class="btn btn-info btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#agregarCantidadModal{{ $producto->id }}">+</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Crear Producto</button>
        @foreach ($productos as $producto)
        <div class="modal fade" id="agregarCantidadModal{{ $producto->id }}" tabindex="-1" aria-labelledby="agregarCantidadModalLabel{{ $producto->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarCantidadModalLabel{{ $producto->id }}">Agregar Cantidad a {{ $producto->nombre }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('productos.agregar_cantidad', $producto->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <label for="stock" style="color: black;">Cantidad Nueva:</label>
                            <input type="number" id="stock" name="stock" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar Cantidad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </form>
</div>
@endsection

