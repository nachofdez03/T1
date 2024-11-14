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
     
            <ul class="categorias">
                @foreach($categorias as $categoria)
                    <li>
                        <form action="{{ route('tienda') }}" method="GET">
                            <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                             <img src="{{asset($categoria->imagen)}}" 
                             class="{{ $categoriaSeleccionada == $categoria->id ? 'categoria-seleccionada' : '' }}" 
                             alt="" onclick="this.closest('form').submit();">
                             {{-- <h5>{{ $categoria->nombre }}</h5>  --}}
                             {{-- Usamos un operador ternario para comprobar si la categoria esta mostrada --}}

                        
                            {{-- <button type="submit" class="btn btn-link">{{ $categoria->nombre }}</button> 
                             Optamos por la opcion de darle a la imagen en vez de al boton, pero esta seria otra opcion--}}
                        </form>
                    </li>
                @endforeach
            </ul>
    
            
            <div class="container productos ">

                {{-- @if ($categoriaSeleccionadaNombre)
                <h2 class="categoria-seleccionada-nombre">{{ $categoriaSeleccionadaNombre->nombre }}</h2>
                @endif --}}

                <div class="row full-width-row">    
                    @foreach($productos as $producto)
                     <div class="col-md-3 mb-4 d-flex flex-column align-items-center" >
                        {{-- Ahora en vez de usar un input oculto, lo mandamos en el formulario al controlador --}}
                         <form action="{{route('producto',$producto->id)}}" method="GET">
                            <div class="card producto-carta" style="width: 100%; text-align: center;" onclick="if ({{ $producto->stock }} > 0) { this.closest('form').submit(); }">
                            
                                <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                                    @if ($producto->stock == 0)
                                        <div class="sold-out" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(124, 115, 115, 0.7); color: black; display: flex; align-items: center; justify-content: center; font-size: 2em; font-weight: bold;">
                                         <h5 style="background-color: white">Sold Out</h5>
                                        </div>
                                    @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="card-text">Precio: {{ $producto->precio }}€</p>
                                </div>
                            </div>
                         </form>
                     </div>
                    @endforeach
                </div>
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

        <script>
            // JavaScript para controlar el menú desplegable
            document.addEventListener("DOMContentLoaded", function() {
                const dropdownToggle = document.getElementById("adminDropdown");
                const dropdownMenu = document.getElementById("adminDropdownMenu");
        
                dropdownToggle.addEventListener("click", function(event) {
                    event.preventDefault(); // Previene el comportamiento por defecto del enlace
                    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block"; // Alterna la visibilidad del menú
                });
        
                // Cierra el menú si se hace clic fuera de él
                document.addEventListener("click", function(event) {
                    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.style.display = "none"; // Cierra el menú si se hace clic fuera de él
                    }
                });
            });
        </script>
    </body>
</html>
