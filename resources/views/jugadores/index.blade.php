<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jugadores</title>
</head>
<body>
    <h1>Lista de Jugadores</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('jugadores.create') }}">Crear Nuevo Jugador</a>

    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apodo</th>
                <th>Fecha de Nacimiento</th>
                <th>País</th>
                <th>Posición</th>
                <th>Logo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jugadores as $jugador)
            <tr>
                <td>{{ $jugador->Nombre }}</td>
                <td>{{ $jugador->Apodo }}</td>
                <td>{{ $jugador->FechaNacimiento }}</td>
                <td>{{ $jugador->Pais }}</td>
                <td>{{ $jugador->Posicion }}</td>
                <td>
                    @if($jugador->Logo)
                        <img src="{{ asset('storage/' . $jugador->Logo) }}" alt="Logo" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('jugadores.show', $jugador->JugadorId) }}">Ver</a>
                    <a href="{{ route('jugadores.edit', $jugador->JugadorId) }}">Editar</a>
                    <form action="{{ route('jugadores.destroy', $jugador->JugadorId) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
