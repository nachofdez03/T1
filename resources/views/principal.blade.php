<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>T1</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   
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
                <a href="">asdasdas</a>
                <a href="{{route('login')}}">Login</a>
            </nav>            
        </div>
    </header>

    <main>
        <div class="Carrusel">
            <div class="contenedor">
                <img src="{{asset('images/Carrusel1.jpg')}}" alt="">

            </div>



        </div>

    </main>

    <footer>

    </footer>
        
        
        {{-- <a href="{{ route('jugadores.index') }}">Ver Lista de Jugadores</a> --}}
    </div>
</body>
</html>
