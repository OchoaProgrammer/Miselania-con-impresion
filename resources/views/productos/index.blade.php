
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Document</title>

    <style>
        body {
            background: linear-gradient(to right, #004ff8, #a4cee2); /* Color de fondo */
            color: whitesmoke;
            background-position: center center;
            box-shadow:#000000;
            display: flex; /* Usamos flexbox para organizar los elementos */
            flex-direction: column; /* Establecemos la dirección de flexión vertical */
            align-items: center; /* Alineamos los elementos al centro horizontalmente */
            min-height: 100vh; /* Hacemos que el cuerpo ocupe al menos toda la altura de la ventana */
        }

        h1 {
            margin-top: 2%;
            border-radius: 5%;
            color: #ffffff; /* Color de texto */
            text-align: center;
            width: 100%; /* Hacemos que el título ocupe todo el ancho disponible */
        }
        </style>

</head>
<body>
    <div class="container">
        <h1>Productos</h1>
        <form action="{{ route( 'producto.create' ) }}" method="get">
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio de Compra</th>
                    <th scope="col">Precio de Venta</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($productos as $producto )


                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->cantidad }} </td>
                    <td>{{ $producto->preciocomprado }} </td>
                    <td>{{ $producto->precioventa}} </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            <button type="submit" class="btn btn-success">Crear Producto</button>
</body>
</html>
