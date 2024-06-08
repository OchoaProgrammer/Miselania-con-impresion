@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<style>
    body {
    background: linear-gradient(to right, #004ff8, #a4cee2);
    color: whitesmoke;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    color: #ffffff;
    text-align: center;
}

.cards-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap; /* Ahora permitimos que las tarjetas se envuelvan */
}

.card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    width: calc(33.33% - 20px); /* Ancho de las tarjetas */
    margin: 0 10px 20px; /* Espacio entre las tarjetas */
    flex-grow: 1; /* Para que las tarjetas ocupen el mismo espacio */
}

.profile-pic {
    width: 100%;
    height: auto;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-content {
    padding: 20px;
}

h2 {
    margin-top: 0;
    color: #000000;
    text-align: center; /* Ahora centraremos los títulos */
}

.btn {
    display: block;
    width: 100%;
    padding: 10px 20px;
    font-size: 16px;
    color: #ffffff;
    background-color: #000000;
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s;
    margin-top: 10px; /* Espacio superior entre los botones */
}

.btn:hover {
    background-color: #00b300;
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #545b62;
}

</style>
    <div class="container">
        <h1>Clientes</h1>
        <form action="{{ route('cliente.create') }}" method="get">
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
                    <a href="{{ route('cliente.create') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Compras</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
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
@endsection
