<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura</title>
<style>
    /* Estilos generales para toda la página */
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
        width: 58mm; /* Ancho del papel de la impresora */
    }

    /* Estilo para el contenedor principal */
    .factura {
        width: 100%;
        padding: 0;
        margin: 0;
    }

    /* Estilo para el encabezado */
    .header {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Estilo para la información del cliente */
    .info {
        margin-bottom: 10px;
    }

    .cliente p {
        margin: 2px 0;
    }

    /* Estilo para la tabla de productos */
    .productos table {
        width: 100%;
        border-collapse: collapse;
    }

    .productos th, .productos td {
        border-bottom: 1px dashed #000;
        padding: 2px;
        text-align: left;
    }

    .productos th {
        font-size: 12px;
        font-weight: bold;
    }

    .productos td {
        font-size: 12px;
    }

    /* Estilo para el total */
    .total {
        text-align: right;
        font-weight: bold;
        margin-top: 10px;
    }

    /* Estilo para el pie de página */
    .footer {
        text-align: center;
        font-size: 10px;
        margin-top: 10px;
        border-top: 1px dashed #000;
        padding-top: 5px;
    }

    /* Estilos específicos para impresión */
    @media print {
        body {
            width: 58mm; /* Ancho del papel de la impresora */
        }

        .factura {
            padding: 0;
            margin: 0;
        }

        .productos th, .productos td {
            border: none; /* Eliminar bordes de la tabla */
        }

        .footer {
            border: none; /* Eliminar borde superior del pie de página */
            margin-top: 5px;
            padding-top: 0;
        }

        /* Ajustar el tamaño de la página al contenido */
        @page {
            margin: 0;
        }
    }
</style>
</head>
<body>
    <div class="factura">
        <div class="header">
            <h2>Factura #{{ $venta->id }}</h2>
        </div>
        <div class="info">
            <div class="cliente">
                <p><strong>Nombre:</strong> {{ $venta->cliente->nombre }}</p>
                <p><strong>Fecha y hora:</strong> {{ $venta->fecha }}</p>
            </div>
        </div>
        <div class="productos">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->pivot->cantidad }}</td>
                            <td>{{ number_format($producto->pivot->cantidad * $producto->pivot->precio, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            <h3><strong>Total a pagar:</strong> {{ number_format($venta->total, 0, ',', '.') }}</h3>
        </div>
        <div class="footer">
            DISTRIBUIDORA JF <br>
            JULIAN ESTEBAN MARIN <br>TEL: +57 310 3476304<br>NIT: 1037501728-9 <br>DIRECCION: CRA 33 #56-56 MED. BOSTON
            <br><br><strong>Gracias por su compra</strong>
        </div>
    </div>
    <button onclick="window.print()">Imprimir</button>
</body>
</html>
