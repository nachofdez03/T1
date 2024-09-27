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
                <a href="">asdasdsa</a>
                <a href="">asdasdas</a>
                <a href="">asasdasd</a>
                <a href="{{ route('nosotros')}}">Sobre Nosotros</a>
                <a href="{{ route('tienda')}}">Tienda</a>

                @if(Auth::check())
                    @if(Auth::user()->isAdmin())  {{-- Auth::user(); Retorna el usuario autenticado o null si no hay uno  --}}
                    <a href="">Administración</a>
                    @endif
              
                
              
                <a href=""
                {{-- Con el event.preventDefault() le decimos al navegador 
                "No sigas el enlace. Vamos a hacer algo diferente". y debido a que el formulario solo
                 se envia con un submit pues le damos al submit para que se envie y se active el action
                 que es el metodo --}}
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
        
                <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
                    @csrf
                @else
                <a href="{{ route('login') }}">Login</a>
                @endif
            </nav>            
        </div>
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
        
        
        {{-- <a href="{{ route('jugadores.index') }}">Ver Lista de Jugadores</a> --}}
    </div>
</body>
</html>
