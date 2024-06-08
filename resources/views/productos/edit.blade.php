@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $producto->stock }}">
        </div>
        <div class="mb-3">
            <label for="preciocomprado" class="form-label">Precio de Compra</label>
            <input type="text" class="form-control" id="preciocomprado" name="preciocomprado" value="{{ $producto->preciocomprado }}">
        </div>
        <div class="mb-3">
            <label for="precioventa" class="form-label">Precio de Venta</label>
            <input type="text" class="form-control" id="precioventa" name="precioventa" value="{{ $producto->precioventa }}">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select class="form-select" id="categoria" name="categoria_id">
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
