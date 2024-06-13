@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background: linear-gradient(to right, #004ff8, #a4cee2);
        color: whitesmoke;
        font-family: Arial, sans-serif;
    }
    .card {
        background-color: #333;
        color: whitesmoke;
    }
    .card-header, .card-title {
        font-weight: bold;
    }
</style>
<br>

<div class="container mt-5">
    <h1 class="mb-4">Distribuidora JF</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Card 1: Total Clientes -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Clientes</h5>
                    <p class="card-text">Actualmente tienes {{ number_format($totalClientes, 0, ',', '.') }} clientes registrados.</p>
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary">Ver Clientes</a>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Productos -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Productos</h5>
                    <p class="card-text">Actualmente tienes {{ number_format($totalProductos, 0, ',', '.') }} productos en tu inventario.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-primary">Ver Productos</a>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Ventas -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Ventas</h5>
                    <p class="card-text">Has realizado {{ number_format($totalVentas, 0, ',', '.') }} ventas hasta la fecha.</p>
                    <p class="card-text">El valor total de todas las ventas es: {{ number_format($ventasTotales, 0, ',', '.') }}</p>
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary">Ver Ventas</a>
                </div>
            </div>
        </div>

        <!-- Card 4: Total Categorías -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Categorías</h5>
                    <p class="card-text">Has registrado {{ number_format($totalCategorias, 0, ',', '.') }} categorías hasta la fecha.</p>
                    <a href="{{ route('categorias.index') }}" class="btn btn-primary">Ver Categorías</a>
                </div>
            </div>
        </div>

        <!-- Card 5: Inversión Total -->
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Inversión Total</h5>
                    <p class="card-text">La inversión total en productos es: {{ number_format($inversionTotal, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Ganancias Mensuales
                    </div>
                    <div class="card-body">
                        <canvas id="gananciasChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Inversiones Mensuales
                    </div>
                    <div class="card-body">
                        <canvas id="inversionesChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctxGanancias = document.getElementById('gananciasChart').getContext('2d');
        var myChartGanancias = new Chart(ctxGanancias, {
            type: 'line',
            data: {
                labels: {!! $labels->toJson() !!},
                datasets: [
                    {
                        label: 'Ganancias Mensuales',
                        data: {!! $gananciasData->toJson() !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: true // Rellenar el área bajo la línea
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value.toLocaleString('en-US') : value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'black' // Color del texto de la leyenda
                        }
                    }
                }
            }
        });

        var ctxInversiones = document.getElementById('inversionesChart').getContext('2d');
        var myChartInversiones = new Chart(ctxInversiones, {
            type: 'line',
            data: {
                labels: {!! $labels->toJson() !!},
                datasets: [
                    {
                        label: 'Inversiones Mensuales',
                        data: {!! $inversionesData->toJson() !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: true // Rellenar el área bajo la línea
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value.toLocaleString('en-US') : value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'black' // Color del texto de la leyenda
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
