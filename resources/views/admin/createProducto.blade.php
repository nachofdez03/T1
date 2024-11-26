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
                    <a href= "{{route('carrito')}}" class="carrito-link">
                        <img src="{{ asset('images/Carrito.png') }}" alt="Carrito" id="carrito-icon">
                    </a>
                    <a href="https://lol.fandom.com/wiki/T1">Leaguepedia</a>
                    <a href="{{ route('nosotros')}}">Sobre Nosotros</a>
                    <a href="{{ route('tienda')}}">Tienda</a>
    
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin())  {{-- Auth::user(); Retorna el usuario autenticado o null si no hay uno  --}}
                        <div class="dropdown">
                            <a href="#" id="adminDropdown" class="dropdown-toggle">Administración</a>
                            <div class="dropdown-menu" id="adminDropdownMenu" style="background-color: black">
                                <a class="dropdown-item" href="{{ route('createProducts')}}" id="colorDespegable">Crear Productos</a>
                                <a class="dropdown-item" href="{{ route('deleteProducts')}}" id="colorDespegable">Borrar Productos</a>
                                <a class="dropdown-item" href="{{ route('createCategoria') }}" id="colorDespegable">Crear Categoría</a>
                                <a class="dropdown-item" href="{{ route('deleteCategorias') }}" id="colorDespegable">Borrar Categoría</a>
                                <a class="dropdown-item" href="{{ route('updateStock')}}" id="colorDespegable">Modificar Stock</a>
                                <a class="dropdown-item" href="{{ route('pedidos')}}" id="colorDespegable">Pedidos</a>
    
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
        </header>
        <main>
            <h2 class="mb-3" style=" text-align: center;margin-top: 2em;">Crear Producto</h2>
            <div class="mt-5" style="padding-top: 2em; margin-bottom: 10em"> <!-- Margen superior para separar del producto -->
                <form action="{{ route('createProducts.store') }}" method="POST" enctype="multipart/form-data" class="FormCreateProductos">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" min="1" required >
                    </div>
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoría</label>
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            <option value="">Seleccionar categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4">Crear Producto</button>
                </form>
                
            </div><!-- Margen superior para separar del producto -->
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
    
                // Es un hover en vez de CSS con JS, cambia la misma imagen al pasar el raton o dejarlo de pasar
                // Son la misma foto pero con diferente color ahi la diferencia que podemos apreciar
                document.getElementById('carrito-icon').addEventListener('mouseover', function () {
                this.src = "{{ asset('images/Carrito2.png') }}";});
    
                document.getElementById('carrito-icon').addEventListener('mouseout', function () {
                this.src = "{{ asset('images/Carrito.png') }}";});
        </script>
    </body>
</html>
