<!-- resources/views/ventas/factura.blade.php -->

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

                        <td>{{ $producto->pivot->cantidad * $producto->pivot->precio }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="total">
        <H3><strong>Total a pagar:</strong> {{ $venta->total }}</H3>
    </div>
    <div class="footer">
        DISTRIBUIDORA JF <br>
        JULIAN ESTEBAN MARIN <br>TEL: +57 310 3476304<br>NIT: 1037501728-9 <br>DIRECCION: CRA 33 #56-56 MED. BOSTON
        <BR>
        <BR> <STRONg>  Gracias por su compra</STRONg></BR></BR>
    </div>
</div>

<style>
    .factura {
        width: 50mm;
        margin: 0 auto;
        padding: 5px;
        border: 1px solid #ccc;
        font-size: 8px;
        font-family: Arial, sans-serif;
    }

    .header {
        text-align: center;
        margin-bottom: 5px;
    }

    .info {
        margin-bottom: 5px;
    }

    .productos {
        margin-bottom: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 8px;
    }

    th, td {
        border: 1px solid #000;
        padding: 2px;
        text-align: center;
        word-wrap: break-word;
    }

    .total {
        text-align: center;
        margin-bottom: 5px;
    }

    .total p {
        font-weight: bold;
    }

    .footer {
        text-align: center;
        margin-top: 5px;
        font-size: 8px;
    }
</style>
