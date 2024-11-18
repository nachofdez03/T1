<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
</head>
<body>
    <header>
        <div class="contenedor">
            <a href="{{ route('home')}}" class="image-link"><img src="{{ asset('images/T1_Logo.jpg') }}" alt="Logo"></a>
            <nav class="menu">
                <a href="{{ route('carrito')}}" class="carrito-link">
                    <img src="{{ asset('images/Carrito.png') }}" alt="Carrito" id="carrito-icon">
                </a>
                <a href="{{ route('nosotros')}}">Sobre Nosotros</a>
                <a href="{{ route('tienda')}}">Tienda</a>

                @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                    <div class="dropdown">
                        <a href="#" id="adminDropdown" class="dropdown-toggle">Administración</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('createProducts')}}">Crear Productos</a>
                            <a class="dropdown-item" href="{{ route('deleteProducts')}}">Borrar Productos</a>
                            <a class="dropdown-item" href="{{ route('updateStock')}}">Modificar Stock</a>
                            <a class="dropdown-item" href="{{ route('pedidos')}}">Pedidos</a>
                        </div>
                    </div>
                    @endif
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </nav>
        </div>
    </header>

    <main>
        <div class="contenedor">
            <h2 class="mb-4 text-center" style="margin-top: 1em">Carrito de Compras</h2>

            @if (session('exito'))
                <div class="alert alert-success">
                    {{ session('exito') }}
                </div>
            @endif

            @if (count($carrito) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carrito as $id => $producto)
                            <tr>
                                <td>{{ $producto['nombre'] }}</td>
                                <td>{{ number_format($producto['precio'], 2) }} €</td>
                                <td>
                                    <form action="{{ route('carrito.actualizar', $id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="cantidad" value="{{ $producto['cantidad'] }}" min="1" required>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </td>
                                <td>{{ number_format($producto['precio'] * $producto['cantidad'], 2) }} €</td>
                                <td>
                                    <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="total">
                    <h3>Total: {{ number_format(array_sum(array_map(function ($producto) {
                        return $producto['precio'] * $producto['cantidad'];
                    }, $carrito)), 2) }} €</h3>
                </div>

                <div class="acciones">
                    <a href="{{ route('carrito.vaciar') }}" class="btn btn-dark">Vaciar carrito</a>
                    <a href="" class="btn btn-dark">Proceder a la compra</a>
                </div>
            @else
                <p class="text-center">No hay productos en el carrito.</p>
            @endif
        </div>
    </main>

    <footer>
        <!-- Aquí va el pie de página -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
