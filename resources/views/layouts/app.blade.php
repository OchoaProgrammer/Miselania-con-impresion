<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Distribuidora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header bg-dark"> <!-- Cambiando el fondo del título del menú a negro -->
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: white;">Menu</h5> <!-- Haciendo que el texto sea blanco -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="background-color: #343a40;"> <!-- Cambiando el fondo del offcanvas-body a negro -->
                    <ul class="navbar-nav flex-grow-1 pe-3 "> <!-- Quitando la clase justify-content-end y agregando bg-dark para el fondo oscuro -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clientes.index') }}" style="color: white;">Clientes</a> <!-- Haciendo que el texto sea blanco -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categorias.index') }}" style="color: white;">Categorias</a> <!-- Haciendo que el texto sea blanco -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.index') }}" style="color: white;">Productos</a> <!-- Haciendo que el texto sea blanco -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ventas.index') }}" style="color: white;">Ventas</a> <!-- Haciendo que el texto sea blanco -->
                        </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


<div class="container mt-5">
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->


<!-- Scripts -->
@yield('scripts')

</body>
</html>
