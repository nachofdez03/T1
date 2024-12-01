<!doctype html>
<html lang="en">
    <head>
        <title>Producto</title>
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
        <link rel="icon" href="{{ asset('images/T1.png') }}" type="image/x-icon">

    </head>

    <body>
        <header>
            <div class="contenedor">
                <a href="{{ route('home')}}" class="image-link"><img src="{{ asset('images/T1_Logo.jpg') }}" alt=""></a>
                <!-- Botón de menú hamburguesa -->
                <button id="menu-toggle" class="hamburger-menu" aria-label="Abrir menú">
                    ☰
                </button>
    
                <nav class="menu" id="mobile-menu">
                    <button id="menu-close" class="close-button">✖</button>
                    <a href="{{ route('carrito') }}" class="carrito-link">
                        <img src="{{ asset('images/Carrito.png') }}" alt="Carrito" id="carrito-icon">
                    </a>
                    <a href="https://lol.fandom.com/wiki/T1">Leaguepedia</a>
                    <a href="{{ route('nosotros')}}">Sobre Nosotros</a>
                    <a href="{{ route('tienda')}}">Tienda</a>
                    
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin())
                        <div class="dropdown">
                            <a href="#" id="adminDropdown" class="dropdown-toggle">Administración</a>
                            <div class="dropdown-menu" id="adminDropdownMenu" style="background-color: black">
                                <a class="dropdown-item" href="{{ route('createProducts') }}">Crear Productos</a>
                                <a class="dropdown-item" href="{{ route('deleteProducts') }}">Borrar Productos</a>
                                <a class="dropdown-item" href="{{ route('createCategoria') }}">Crear Categoría</a>
                                <a class="dropdown-item" href="{{ route('deleteCategorias') }}">Borrar Categoría</a>
                                <a class="dropdown-item" href="{{ route('updateStock') }}">Modificar Stock</a>
                                <a class="dropdown-item" href="{{ route('pedidos') }}">Pedidos</a>
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
    
        <main class="mainProducto">

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
        <footer class="footer"> 
            <div class="SocialMedia">
              <div class="Síguenos">
              </div>
      
              <div class="Iconos">
                <ul class="lista_iconos">
                    <li><a><img src="{{ asset('images/Redes Sociales/Facebook.png') }}" class="fotoIcono" alt="Facebook"></a></li>
                    <li><a><img src="{{ asset('images/Redes Sociales/Instagram.png') }}" class="fotoIcono" alt="Instagram"></a></li>
                    <li><a><img src="{{ asset('images/Redes Sociales/Youtube.png') }}" class="fotoIcono" alt="YouTube"></a></li>
                    <li><a><img src="{{ asset('images/Redes Sociales/Tik tok.png') }}" class="fotoIcono" alt="TikTok"></a></li>
                </ul>
              </div>
            </div>
    
            <hr>
    
            <nav class="nav_footer">
    
                <div class="column">
                  <h3>LCK Roster</h3>
                  <div class="enlaces">
                    <a href="">Doran</a>
                    <a href="">Oner</a>
                    <a href="">Faker</a>
                    <a href="">Gumayusi</a>
                    <a href="">Keria</a>
              
                  </div>
                </div>
        
                <div class="column">
                  <h3>LCK CL Roster</h3>
                  <div class="enlaces">
                    <a href="">Dal</a>
                    <a href="">Guwon</a>
                    <a href="">Poby</a>
                    <a href="">Smash</a>
                    <a href="">Rekkles</a>
                    <a href="">Cloud</a>
                  </div>
                </div>
        
                <div class="column">
                  <h3>Valorant Roster</h3>
                  <div class="enlaces">
                    <a href="">Sylvan</a>
                    <a href="">Izu</a>
                    <a href="">BuZz</a>
                    <a href="">Meteor</a> 
                    <a href="">stax</a>  
                    <a href="">carpe</a>  
    
                  </div>
                </div>
        
                <div class="column">
                  <h3>Information</h3>
                  <div class="enlaces">
                    <a href="">Shop</a>
                    <a href="">T1 Channel</a>
                    <a href="">Calendar</a>
                    <a href="">Login</a>      
                  </div>
                </div>
        
              </nav>
    
              <div class="footerLast" style="background-color: black">
                <p>COPYRIGHTⓒ2024 T1 SHOP. ALL RIGHTS RESERVERED.</p>
              </div>
    
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
    
                // Es un hover en vez de CSS con JS, cambia la misma imagen al pasar el raton o dejarlo de pasar
                // Son la misma foto pero con diferente color ahi la diferencia que podemos apreciar
                document.getElementById('carrito-icon').addEventListener('mouseover', function () {
                this.src = "{{ asset('images/Carrito2.png') }}";});
    
                document.getElementById('carrito-icon').addEventListener('mouseout', function () {
                this.src = "{{ asset('images/Carrito.png') }}";});
    
        </script>
        <script src="{{ asset('js/menuHamburguesa.js') }}"></script>



    </body>
</html>
