<!doctype html>
<html lang="en">
    <head>
        <title>Tienda</title>
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
    
        <main>
     
            <div class="container categorias categorias-row">
                <div class="row full-width-row">
                    @foreach($categorias as $categoria)
                    <div class="col-md-2 mb-4 mx-2 d-flex flex-column align-items-center categoria-item">
                        <form action="{{ route('tienda') }}" method="GET">
                                <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                                <img src="{{ asset($categoria->imagen) }}" 
                                     class="{{ $categoriaSeleccionada == $categoria->id ? 'categoria-seleccionada' : '' }}" 
                                     alt="{{ $categoria->nombre }}" 
                                     onclick="this.closest('form').submit();">
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container productos ">

                {{-- @if ($categoriaSeleccionadaNombre)
                <h2 class="categoria-seleccionada-nombre">{{ $categoriaSeleccionadaNombre->nombre }}</h2>
                @endif --}}

                <div class="row full-width-row">    
                    @foreach($productos as $producto)
                     <div class="col-md-3 mb-4 d-flex flex-column align-items-center" id="productosTienda">
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
            <script src="{{ asset('js/menuHamburguesa.js') }}"></script>

    </body>
</html>
