<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>T1</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="icon" href="{{ asset('images/T1.png') }}" type="image/x-icon">

</head>
<body style="background-color: black">

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
                {{-- Con el event.preventDefault() le decimos al navegador 
                "No sigas el enlace. Vamos a hacer algo diferente". y debido a que el formulario solo
                 se envia con un submit pues le damos al submit para que se envie y se active el action
                 que es el metodo --}}
    </header>

    <main>
        <div class="Carrusel">
            <div >
                <div class="carrusel-contenedor-imagenes">
                    <img src="{{ asset('images/T1Carrusel.png') }}" alt="Imagen 1">
                    <img src="{{ asset('images/T1Carrusel2.jpg') }}" alt="Imagen 1">
                    <img src="{{ asset('images/T1Carrusel4.jpg') }}" alt="Imagen 1">

                </div>
                
                <!-- Controles de navegación -->
                <button class="prev" onclick="moverCarrusel(-1)">&#10094;</button>
                <button class="next" onclick="moverCarrusel(1)">&#10095;</button>
            </div>

        <div class="info-box">
            <p>ESPORTS APPAREL</p>
            <h2>T1 COLLECTION</h2>
        </div>

        <div class="containerPhotos">
            <div class="image-box">
                <img src="{{ asset('images/T1 Vertical2.jpg') }}" alt="Foto 1" class="photo-1">
                <a href="https://www.youtube.com/@SKTT1" class="shop-button">T1 Channel</a>
            </div>
            <div class="image-box">
                <img src="{{ asset('images/T1 shop.webp') }}" alt="Foto 2" class="photo-2">
                <a href="{{ route('tienda') }}" class="shop-button">Ir a la Tienda</a>
            </div>
        </div>
        <div class="info-box" style="background-color: black">
            <p>CHECK</p>
            <h2>OUR LATEST VIDEOS
            </h2>
        </div>
        <div class="youtube-videos" style="background: linear-gradient(
        to bottom,
        black,
        #e30a2d";>
            <div class="video-grid">
                <!-- Video 1 -->
                <iframe 
                    src="https://www.youtube.com/embed/fi4XrnTy54s" 
                    title="Video 1" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                
                <!-- Video 2 -->
                <iframe 
                    src="https://www.youtube.com/embed/MPcUGG8zvrc" 
                    title="Video 2" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                
                <!-- Video 3 -->
                <iframe 
                    src="https://www.youtube.com/embed/lTMv27YJc_I" 
                    title="Video 3" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                
                <!-- Video 4 -->
                <iframe 
                    src="https://www.youtube.com/embed/yq6Umbfcm7c" 
                    title="Video 4" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                
                <!-- Video 5 -->
                <iframe 
                    src="https://www.youtube.com/embed/GagsR5-bdLs" 
                    title="Video 5" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
                
                <!-- Video 6 -->
                <iframe 
                    src="https://www.youtube.com/embed/MviIDKKvex0" 
                    title="Video 6" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <div class="photo-gallery">
            <h2 style="font-size: 3em; color:white;">WHERE T1 COMPETE</h2>
            <div class="photo-row">
                <!-- Foto 1 -->
                <img src={{ asset('images/games/lck.jpg')}} alt="Foto 1">
                
                <!-- Foto 2 -->
                <img src={{ asset('images/games/lckcl.jpg')}} alt="Foto 2">
                
                <!-- Foto 3 -->
                <img src={{ asset('images/games/val.jpg')}} alt="Foto 3">
                
                <!-- Foto 4 -->
                <img src={{ asset('images/games/cc.jpg')}} alt="Foto 4">
            </div>
        </div>
        
        
        

{{-- 
        <div>
            <img src="{{ asset('images/Publicidad.png') }}" style="max-width: 100%; " alt="">
        </div>
         --}}
        {{-- <div>
        <img src="{{ asset('images/Diseño.png') }}" alt="" style="width: 100%; height:auto">
        </div> --}}

        {{-- 
        --}}
        
      
        {{-- <!-- Mensajes de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}

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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
    var map = L.map('map').setView([37.512402, 127.042834], 13);  // Puedes cambiar las coordenadas aquí
    
    // Usar OpenStreetMap como capa base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Añadir un marcador en las mismas coordenadas
    var marker = L.marker([37.512402, 127.042834]).addTo(map);
    marker.bindPopup("<b>Tienda Física</b>").openPopup();
</script>

<script>
    let indiceActual = 0;

function moverCarrusel(direccion) {
    const carrusel = document.querySelector('.carrusel-contenedor-imagenes');
    const totalImagenes = document.querySelectorAll('.carrusel-contenedor-imagenes img').length;

    // Actualizar índice de la imagen activa
    indiceActual += direccion;

    // Reiniciar al inicio o final si se sale de los límites
    if (indiceActual < 0) {
        indiceActual = totalImagenes - 1;
    } else if (indiceActual >= totalImagenes) {
        indiceActual = 0;
    }

    // Desplazar el carrusel
    const desplazamiento = -indiceActual * 33.33; // Desplazamiento en porcentaje (cada imagen ocupa el 33.33%)
    carrusel.style.transform = `translateX(${desplazamiento}%)`;
}

setInterval(() => {
    moverCarrusel(1);
}, 5000); // Cambia la imagen cada 5 segundos

</script>
    
</body>
</html>
