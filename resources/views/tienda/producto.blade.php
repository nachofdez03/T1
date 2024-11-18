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
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="{{asset('css/style.css')}}">
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

            <div class="container d-flex justify-content-center pdt-1 ">
                <div class="">
                    <img src="{{asset($producto->imagen)}}" alt="{{asset($producto->nombre)}}">
                </div>

                <div class="text-center informacion">
                    <h5 style="font-size: 2em">{{$producto->nombre}}</h5>

                    <p class="display-5 fw-bold" style="color: black; font-size: 2em; margin-top: 1em">${{ number_format($producto->precio, 2) }}</p>

                    <div class="mt-4 botonProductoPadre" style="width: 50%; margin-top:10em">
                    
                        <form id="comprar-form-{{ $producto->id }}" action="{{ route('comprar', $producto->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" id="cantidad-{{ $producto->id }}" name="cantidad" class="form-control" min="1" 
                                max="{{ $producto->stock }}" value="1" style="width: 5em; margin: auto; border: 1.2px solid">
                            
                            <!-- Botón para "Comprar" -->
                            <button type="submit" class="w-100 botonProducto mt-4">Comprar</button>
                        </form>

                             <!-- Formulario para "Añadir al carrito" -->
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" style="display: inline;">
                           
                                @csrf
        
                    
                                <button type="submit" class="w-100 botonProducto mt-4">Añadir al carrito</button>
                        </form>

               </div>
                                    

            </div>
            {{-- <p>VISTA TIENDA/PRODUCTO</p>
           <p>{{ $producto->nombre }}</p>
           <p>{{ $producto->precio }}</p> --}}

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
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
