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

        <!-- Bootstrap CSS v5.2.1 -->
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
    
        <main class="container mt-5">
            <div class="container mt-5">
                <h1 class="text-center">Eliminar Productos</h1>
        
                <!-- Formulario para seleccionar la categoría -->
                <form action="{{ route('deleteProducts.filter') }}" method="GET" id="categoryForm" class="mb-4">
                    <label for="categoria_id">Selecciona una categoría:</label>
                    <select class="form-select" name="categoria_id" id="categoria_id" onchange="document.getElementById('categoryForm').submit();">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ (isset($categoria_id) && $categoria_id == $categoria->id) ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </form>
        
                <!-- Mostrar productos de la categoría seleccionada -->
                @if(isset($productos) && count($productos) > 0)
                    <div class="row">
                        @foreach($productos as $producto)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                                        <p class="card-text">{{ $producto->descripcion }}</p>
                                        <p class="card-text">Precio: ${{ $producto->precio }}</p>
                                        <p class="card-text">Stock: {{ $producto->stock }}</p>
                                        <form action="{{ route('deleteProducts.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger w-100" style="border-block-color: black">Eliminar Producto</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif(isset($productos))
                    <p class="text-center mt-4">No hay productos disponibles en esta categoría.</p>
                @endif
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
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
