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
   
</head>
<body>

    <header>
        <div class="contenedor">
            <a href="{{ route('home')}}" class="image-link"><img src="{{ asset('images/T1_Logo.jpg') }}" alt=""></a>
            <nav class="menu">
                <a href= "{{route('carrito')}}" class="carrito-link">
                    <img src="{{ asset('images/Carrito.png') }}" alt="Carrito" id="carrito-icon">
                </a>
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
        <div class="Carrusel">
            <div class="contenedor">
                <img src="{{asset('images/Carrusel1.jpg')}}" alt="">

            </div>



        </div>

        <!-- Mensajes de éxito -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

    </main>

    <footer>

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
