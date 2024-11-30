<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    <link rel="icon" href="{{ asset('images/T1.png') }}" type="image/x-icon">
</head>
        
<body style=" font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;">

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
        
    <div class="info-box" style="background-color: #e30a2d">
        <h1 style="color: white">Sobre nosotros</h1>
       
    </div>
    
    <div class="content">
        <h2>Quienes somos</h2>
        <p>T1 es un equipo profesional de deportes electrónicos 5 veces campeon del mundo, propiedad de la compañía surcoreana de telecomunicaciones SK Telecom. La organización cuenta con representación en varios de los deportes eléctricos más importantes de la actualidad, como lo son League of Legends, Valorant o Apex Legends.</p>
        
        <h2>Nuestra mision</h2>
        <p>Crear valores más allá de las expectativas ofreciendo un esfuerzo excepcional que nos unan como equipo y fomenten las conexiones</p>        
        <h2>Lo que nos hacer estar en la cima</h2>
        <ul>
            <li><strong>Fans:</strong> Tomar cada decision en funcion de los gustos de nuestros fans.</li>
            <li><strong>Esfuerzo:</strong> Dedicamos cada momento del dia en trabajar para mantenernos en la cima.</li>
            <li><strong>Pasion:</strong> Luchar por aquello que amamos y nos une.</li>
        </ul>
        <h2>T1 Worlds Champions</h2>
        <ul>
            <li><strong>2013 - USA </strong> </li>
            <li><strong>2015 - EUROPE </strong> </li>
            <li><strong>2016 - USA </strong> </li>
            <li><strong>2023 - KOREA </strong> </li>
            <li><strong>2024 - EUROPE </strong> </li>
        </ul>
    </div>
    
    
    <div class="gallery">
        <h2>Our Journey in Pictures</h2>
        <p>T1 is the past, present and future</p>
        <div class="gallery-container">
            <div class="gallery-item">
                <img src="{{ asset('images/T1 Wall2.png') }}" alt="Office space">
                <h3>La primera dinastia</h3>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/T1 Wall1.jpg') }}" alt="Office space">
                <h3>Exito</h3>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/T1 shop.png') }}" alt="Product launch">
                <h3>Un sentimiento inexpicable</h3>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/T1_Logo.jpg') }}" alt="Sustainability project">
                <h3>Nuestra Identidad</h3>
            </div>
        </div>
    </div>
    <div class="info-box2"  style="background-color: white">
        <h2 style="color: BLACK">LOCALIZATION
        </h2>
    </div> 
    <div class="map-container" style="background: linear-gradient(
        to bottom,
        white,
        black">
           <div id="map">
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