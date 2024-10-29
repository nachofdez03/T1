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

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="{{asset('css/style.css')}}">
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

            <div class="container d-flex justify-content-center pdt-1 ">
                <div class="">
                    <img src="{{asset($producto->imagen)}}" alt="{{asset($producto->nombre)}}">
                </div>

                <div class="text-center informacion">
                    <h5 style="font-size: 2em">{{$producto->nombre}}</h5>

                    <p class="display-5 fw-bold" style="color: black; font-size: 2em; margin-top: 1em">${{ number_format($producto->precio, 2) }}</p>

                    <!-- Input para seleccionar cantidad -->
                    <div class="mt-4">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" value="1" style="width: 5em; margin: auto; border: 1.2px solid">
                    </div>

                    <div class="mt-4 botonProductoPadre" style="width: 50%; margin-top:10em">
                        <button class="btn btn-light mb-3 w-100 botonProducto" style="background-color: white;">Añadir al carrito</button>
                        <button class="btn btn-light w-100 botonProducto" style="background-color: white; ">Comprar</button>
                    </div>
                    

                </div>

               











            {{-- <p>VISTA TIENDA/PRODUCTO</p>
           <p>{{ $producto->nombre }}</p>
           <p>{{ $producto->precio }}</p> --}}

        </main>
        <footer>
            <!-- place footer here -->
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
    </body>
</html>
