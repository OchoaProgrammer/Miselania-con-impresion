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


</style>
<body>

    <div class="container">
        <h1>Categorias</h1>
        <form action="{{ route('categorias.create') }}" method="get">
            <button type="submit" class="btn btn-success">Crear Categoria</button>
        </form>
    </div>
    <div class="container">
        <form action="{{ route( 'categorias.create' ) }}" method="get">
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Categoria</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($categorias as $categoria )
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                  </tr>
                </div>
                @endforeach
            </div>
        @endsection
