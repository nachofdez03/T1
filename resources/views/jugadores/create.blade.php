<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Jugador</title>
</head>
<body>
    <h1>Crear Jugador</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jugadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="Nombre">Nombre:</label>
        <input type="text" name="Nombre" id="Nombre" value="{{ old('Nombre') }}">
        <br>

        <label for="Apodo">Apodo:</label>
        <input type="text" name="Apodo" id="Apodo" value="{{ old('Apodo') }}">
        <br>

        <label for="FechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="FechaNacimiento" id="FechaNacimiento" value="{{ old('FechaNacimiento') }}">
        <br>

        <label for="Pais">País:</label>
        <input type="text" name="Pais" id="Pais" value="{{ old('Pais') }}">
        <br>

        <label for="Posicion">Posición:</label>
        <input type="text" name="Posicion" id="Posicion" value="{{ old('Posicion') }}">
        <br>

        <label for="Logo">Logo:</label>
        <input type="file" name="Logo" id="Logo">
        <br>

        <button type="submit">Guardar</button>
    </form>

    <a href="{{ route('jugadores.index') }}">Volver a la lista</a>
</body>
</html>
