<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Bootstrap CSS v5.2.1 -->
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
            <a href="{{ route('home')}}" class="image-link"><img src="{{ asset('images/T1_Logo.jpg') }}" alt=""></a>
            <nav class="menu">
                <a href="">asdasdsa</a>
                <a href="">asdasdas</a>
                <a href="">asasdasd</a>
                <a href="{{ route('nosotros')}}">Sobre Nosotros</a>
                <a href="{{ route('tienda')}}">Tienda</a>

                @if(Auth::check())
                    @if(Auth::user()->isAdmin())  {{-- Auth::user(); Retorna el usuario autenticado o null si no hay uno  --}}
                    <div class="dropdown">
                        <a href="#" id="adminDropdown" class="dropdown-toggle">Administración</a>
                        <div class="dropdown-menu" id="adminDropdownMenu" style="background-color: black">
                            <a class="dropdown-item" href="{{ route('createProducts')}}" id="colorDespegable">Crear Productos</a>
                            <a class="dropdown-item" href="{{ route('deleteProducts')}}" id="colorDespegable">Borrar Productos</a>
                            <a class="dropdown-item" href="{{ route('updateStock')}}" id="colorDespegable">Modificar Stock</a>
                            <a class="dropdown-item" href="{{ route('pedidos')}}" id="colorDespegable">Pedidos</a>
                            <a class="dropdown-item" href="#" id="colorDespegable">Usuarios</a>
                            <a class="dropdown-item" href="#" id="colorDespegable">Configuraciones</a>
                            <a class="dropdown-item" href="#" id="colorDespegable">Registros</a>
                        </div>
                    </div>
                    @endif
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}">Login</a>
                @endif
            </nav>            
        </div>
                {{-- Con el event.preventDefault() le decimos al navegador 
                "No sigas el enlace. Vamos a hacer algo diferente". y debido a que el formulario solo
                 se envia con un submit pues le damos al submit para que se envie y se active el action
                 que es el metodo --}}
    </header>
    <main>

        {{-- Cuando llamamos a $pedido->productos, Laravel busca los productos que están asociados a ese pedido. Internamente, 
        se realiza una consulta a la tabla intermedia pedido_producto para encontrar todas las filas que tienen el pedido_id 
        que coincide con el id del pedido actual. --}}

        <h2 class="mb-3" style="text-align: center; margin-top: 2em;">Lista de Productos</h2>

            <!-- Filtro de estado -->
            <div class="text-center mb-4">
                <form action="{{ route('pedidos') }}" method="GET">
                    <label for="estado" class="form-label">Filtrar por Estado:</label>
                    <select name="estado" id="estado" class="form-select w-50 mx-auto" onchange="this.form.submit()">
                        <option value="" {{ is_null($estadoFiltro) ? 'selected' : '' }}>Todos</option>
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}" {{ $estadoFiltro == $estado->id ? 'selected' : '' }}>
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        
            @foreach ($pedidos as $pedido)
            <div class="pedido">
                <h2 class="pedido-id">Pedido ID: {{ $pedido->id }}</h2>
                <div class="pedido-info">
                    <p><strong>Cliente:</strong> {{ $pedido->nombre_cliente }}</p>
                    <p><strong>Email:</strong> {{ $pedido->email_cliente }}</p>
                    <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
                    <p><strong>Estado del Pedido:</strong> 
                     <span class="
                        {{ $pedido->pedido_estado_id == 1 ? 'estado-pendiente' : 
                        ($pedido->pedido_estado_id == 2 ? 'estado-enviado' : 'estado-entregado') }}">
                        {{  $pedido->pedido_estado_id == 1 ? 'Pendiente' : ($pedido->pedido_estado_id == 2 ? 'Enviado' : 'Entregado') }}
                    </span>
                    </p>
                    <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
                </div>

                <form action="{{ route('cambiarEstadoPedido', $pedido->id) }}" method="POST" class="d-flex align-items-center mt-3">
                    @csrf
                    @method('PUT')
                    <label for="nuevo_estado" class="form-label">Cambiar Estado:</label>
                    <select name="nuevo_estado" id="nuevo_estado" class=" ms-2">
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}" 
                                {{ $pedido->pedido_estado_id == $estado->id ? 'selected' : '' }}>
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary ms-2">Cambiar</button>
                </form>                
            
                @foreach ($pedido->productos as $producto)
                    <div class="imagen-container container d-flex pdt-1">
                        <div>
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" style="max-width: 150px; border-radius: 8px;">
                        </div>
                        <div class="text-center informacion informacionCompra mx-3">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">Precio unitario: ${{ number_format($producto->precio, 2) }}</p>
                            <p class="card-text">Cantidad: {{ $producto->pivot->cantidad }}</p>
                            <p class="card-text fw-bold">Subtotal: ${{ number_format($producto->pivot->cantidad * $producto->precio, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        
    </main>
    
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
