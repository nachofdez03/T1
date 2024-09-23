<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                @if(Auth::check()) 
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
        

    </main>

        <h1>SEEEEEEEEEEEEEEEEND IT</h1>

    

    <footer>

    </footer>
    
</body>
</html>