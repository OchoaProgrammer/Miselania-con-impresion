@extends('layouts.app')

@section('title', 'Crear Venta')

@section('content')
    <div class="card">
        <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Crear Nueva Venta</h3>
            </div>
            <div class="card-body">
                <div class="form-group col-lg-3">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="">Seleccionar Cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="card col-lg-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoria_id">Categoría:</label>
                                <select name="categoria_id" id="categoria_id" class="form-control" onchange="fetchProductos()" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="producto_id">Producto:</label>
                                <select name="producto_id" id="producto_id" class="form-control" onchange="fetchStock()" required>
                                    <option value="">Seleccione un producto</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="precioventa">Precio de Venta:</label>
                                <input type="text" name="precioventa" id="precioventa" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="text" name="stock" id="stock" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="cantidadvender">Cantidad a vender:</label>
                                <input type="number" name="cantidadvender" id="cantidadvender" class="form-control" required>
                            </div>

                            <button type="button" class="btn btn-primary" onclick="agregarProducto()">Agregar Producto</button>
                        </div>
                    </div>

                    <div class="card col-lg-8">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle_venta">
                                        <!-- Aquí se mostrarán los productos agregados -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="total">Total:</label>
                        <input type="text" name="total" id="total" class="form-control" value="" readonly>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Crear Venta</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fechaInput = document.getElementById('fecha');
            var today = new Date();
            var fechaActual = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
            fechaInput.value = fechaActual;
        });

        function fetchProductos() {
            var categoriaId = document.getElementById('categoria_id').value;
            var productoSelect = document.getElementById('producto_id');

            if (!categoriaId) {
                productoSelect.innerHTML = '<option value="">Seleccione una categoría</option>';
                return;
            }

            fetch(`/productos-por-categoria/${categoriaId}`)
                .then(response => response.json())
                .then(data => {
                    productoSelect.innerHTML = '<option value="">Seleccione un producto</option>';
                    data.forEach(producto => {
                        var option = document.createElement('option');
                        option.value = producto.id;
                        option.textContent = producto.nombre;
                        productoSelect.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
        }

        function fetchStock() {
            var productoId = document.getElementById('producto_id').value;

            if (!productoId) {
                return;
            }

            fetch(`/stock-producto/${productoId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('stock').value = data.stock;
                    document.getElementById('precioventa').value = data.precioventa;
                })
                .catch(error => console.error(error));
        }

        var productosCounter = 0;

        function agregarProducto() {
            var productoId = document.getElementById('producto_id').value;
            var productoNombre = document.getElementById('producto_id').options[document.getElementById('producto_id').selectedIndex].text;
            var cantidad = parseInt(document.getElementById('cantidadvender').value);
            var precioVenta = parseFloat(document.getElementById('precioventa').value); // Capturar el precio de venta ingresado
            var stockDisponible = parseInt(document.getElementById('stock').value);

            if (cantidad > stockDisponible) {
                alert('La cantidad seleccionada excede el stock disponible');
                return;
            }

            // Verificar si el producto ya está en la tabla
            var productosTabla = document.querySelectorAll('#detalle_venta tr');
            var productoRepetido = false;
            var subtotal = cantidad * precioVenta;

            productosTabla.forEach(function(row) {
                var productoIdTabla = row.querySelector('input[name^="productos["][name$="[id]"]').value;
                if (productoId === productoIdTabla) {
                    var cantidadActual = parseInt(row.querySelector('td:nth-child(2)').textContent);
                    cantidad += cantidadActual;
                    var subtotalActual = parseFloat(row.querySelector('td:nth-child(4)').textContent);
                    subtotal += subtotalActual;
                    row.querySelector('td:nth-child(2)').textContent = cantidad; // Actualizar cantidad en la fila
                    row.querySelector('td:nth-child(4)').textContent = subtotal.toFixed(2); // Actualizar subtotal en la fila
                    row.querySelector('input[name^="productos["][name$="[cantidad]"]').value = cantidad; // Actualizar cantidad en el input hidden
                    productoRepetido = true;
                }
            });

            if (!productoRepetido) {
                // Crear una nueva fila en la tabla de detalle con los datos del producto
                var newRow = '<tr>' +
                    '<td>' + productoNombre + '</td>' +
                    '<td>' + cantidad + '</td>' +
                    '<td>' + precioVenta.toFixed(2) + '</td>' +
                    '<td>' + subtotal.toFixed(2) + '</td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(this)">Eliminar</button></td>' +
                    '<input type="hidden" name="productos[' + productosCounter + '][id]" value="' + productoId + '">' +
                    '<input type="hidden" name="productos[' + productosCounter + '][cantidad]" value="' + cantidad + '">' +
                    '<input type="hidden" name="productos[' + productosCounter + '][precio]" value="' + precioVenta + '">' + // Incluir el precio de venta aquí
                    '</tr>';

                // Incrementar el contador de productos
                productosCounter++;

                // Agregar la nueva fila a la tabla de detalle
                document.getElementById('detalle_venta').insertAdjacentHTML('beforeend', newRow);
            }

            // Actualizar el total de la venta
            actualizarTotal();
        }

        function eliminarProducto(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // Actualizar el total de la venta
            actualizarTotal();
        }

        function actualizarTotal() {
            var total = 0;
            var productosTabla = document.querySelectorAll('#detalle_venta tr');
            productosTabla.forEach(function(row) {
                var subtotal = parseFloat(row.querySelector('td:nth-child(4)').textContent);
                total += subtotal;
            });

            document.getElementById('total').value = total.toFixed(2);
        }
    </script>
@endsection
