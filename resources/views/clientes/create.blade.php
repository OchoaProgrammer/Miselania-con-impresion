<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body style="background-color: rgb(255, 255, 255);box-shadow:#000000; ">
    <center>
    <div class="card col-md-2" style="color: rgb(255, 255, 255); text-align: center; display:flex; margin-top:20%; background-color:rgba(31, 25, 25, 0.034);box-shadow:#000000;width: 30%;  " >
    <form action="{{route ('cliente.store') }}"  method="POST" >
        @csrf
            <div class="card-header" style="background-color: rgb(36, 16, 211);box-shadow:#000000;overflow: hidden;">
              Registra tu cliente
            </div>
            <div class="card-body">
    <div class="mb-3">
        <label for="nombre" class="form-label" style="color: black">Nombre del cliente</label>
        <input type="text" id="nombre" name="nombre"
        <br>
        <button type="submit" style="background-color: rgb(36, 16, 211); color:aliceblue; border-radius:10px ; box-shadow:#000000; overflow: hidden;   ">Registrar</button>
      </div>
    </form>
</center>
</body>
</html>
