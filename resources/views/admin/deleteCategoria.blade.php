<!doctype html>
<html lang="en">
<head>
    <title>Borrar Categoria</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <link rel="icon" href="{{ asset('images/T1.png') }}" type="image/x-icon">
    

    <style>


        .card-img-top {
            width: 100%; /* Hace que la imagen ocupe todo el ancho del contenedor */
            height: 12em; /* Ajusta la altura de la imagen */
            object-fit: contain; /* Mantiene la proporción de la imagen y la ajusta */
            margin: 0 auto; /* Centra la imagen */
        }

        /* Asegurarse de que las tarjetas tengan la misma altura */
        .card-body {
            flex-grow: 1; /* Hace que el contenido del cuerpo de la tarjeta ocupe el espacio restante */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Espacia el título y el botón */
        }
    
        .col-md-4 {
            margin-bottom: 0rem; /* Espacio adicional entre las filas */
        }
      
    </style>
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

    <main class="container mt-5 mainDeleteCategorias" style="padding-bottom: 7em">
        <h1 class="text-center">Eliminar Categorías</h1>
    
        <!-- Mostrar categorías de la categoría seleccionada -->
        @if(isset($categorias) && count($categorias) > 0)
            <div class="row" >
                @foreach($categorias as $categoria)
                    <div class="col-md-3 mb-4 grid-container" style=" margin-top: 4em;">
                        <div class="card h-100 text-center " style=" margin-bottom: 4rem;">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset($categoria->imagen) }}" class="card-img-top" alt="{{ $categoria->nombre }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $categoria->nombre }}</h5>
                                <form action="{{ route('deleteCategorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger w-100" style="border-block-color: black">Eliminar Categoría</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif(isset($categorias))
            <p class="text-center mt-4">No hay categorías disponibles.</p>
        @endif
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    
</body>
</html>
