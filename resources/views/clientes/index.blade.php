<!DOCTYPE html>
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

    .container {
        display: flex; /* Usamos flexbox para organizar los elementos */
        justify-content: space-between; /* Distribuimos los elementos en los extremos del contenedor */
        align-items: center; /* Alineamos los elementos al centro verticalmente */
        width: 80%; /* Limitamos el ancho del contenedor para centrarlo */
        margin-left: auto; /* Ajustamos el margen izquierdo para colocar el contenedor en el extremo derecho */
        margin-right: auto; /* Ajustamos el margen derecho para colocar el contenedor en el extremo derecho */
    }

    .btn-crear-cliente {
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .cards-container {
        display: flex; /* Usamos flexbox para organizar las tarjetas horizontalmente */
        flex-wrap: wrap; /* Permitimos que las tarjetas se envuelvan a la siguiente línea si no hay suficiente espacio */
        justify-content: center; /* Centramos las tarjetas horizontalmente */
    }

    .card {
        margin: 20px; /* Espacio entre las tarjetas */
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        overflow: hidden;
        flex: 0 1 auto; /* Ajustamos el crecimiento, la contracción y el tamaño inicial de las tarjetas */
    }

    .profile-pic {
        width: 100%;
        height: auto;
    }

    .card-content {
        padding: 20px;
    }

    .card-content h2 {
        margin: 0;
        font-size: 1.5em;
    }

    .card-content p {
        color: #000000;
        margin: 10px 0 0;
    }

    a {
        background: skyblue transparent;
    }

    .register-button {
        width: 100%;
        text-align: center;
        margin-top: auto;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Clientes</h1>
        <form action="{{ route( 'cliente.create' ) }}" method="get">
            <button type="submit" class="btn btn-success">Crear cliente</button>
        </form>
    </div>

    <div class="cards-container">
        @foreach ($clientes as $index => $cliente)
            <div class="card">
                <img src="" alt="Foto de Perfil" class="profile-pic" id="profile-pic-{{ $index }}">
                <div class="card-content">
                    <h2>{{ $cliente->nombre }}</h2>
                    <br>
                    <a href="{{ route( 'cliente.create' )}}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Compras</a>
                </div>
            </div>
        @endforeach
    </div>
    <script>
    async function getRandomProfilePic() {
        try {
            const response = await fetch('https://randomuser.me/api/');
            const data = await response.json();
            const profilePicUrl = data.results[0].picture.large;
            return profilePicUrl;
        } catch (error) {
            console.error('Error al obtener la foto de perfil:', error);
            return ''; // Retornar cadena vacía en caso de error
        }
    }

    async function setProfilePics() {
        const profilePicElements = document.querySelectorAll('.profile-pic');
        for (let i = 0; i < profilePicElements.length; i++) {
            const profilePicUrl = await getRandomProfilePic();
            profilePicElements[i].src = profilePicUrl;
        }
    }

    // Llamar a la función al cargar la página
    window.onload = setProfilePics;
    </script>
</body>
</html>
