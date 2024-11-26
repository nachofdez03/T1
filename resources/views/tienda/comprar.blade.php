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
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

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
    
        <main class="compra">
            <h2 class="mb-4 text-center" style="margin-top: 1em">Resumen de Compra</h2>
        
            <!-- Resumen del Producto -->
            <div class="imagen-container container d-flex justify-content-center pdt-1 ">
                <div class="">
                    <img src="{{asset($producto->imagen)}}" alt="{{asset($producto->nombre)}}">
                </div>

                <div class="text-center informacion informacionCompra">   
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">Precio unitario: ${{ number_format($producto->precio, 2) }}</p>
                    <p class="card-text">Cantidad: {{ $cantidad }}</p>
                    <p class="card-text fw-bold">Total: ${{ number_format($total, 2) }}</p> 
                </div>
            </div>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
     
            <!-- Formulario de Datos del Cliente -->
            <div class="mt-5" style="padding-top: 4em; margin-bottom: 10em"> <!-- Margen superior para separar del producto -->
                <form id="compra-form" action="{{ route('confirmar', $producto->id) }}" method="POST" class="formulario-compacto">
                    @csrf
                    <h4 class="mb-3">Datos del Cliente</h4>
                
                    <!-- Campo para Nombre Completo -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <!-- Campo para Correo Electrónico -->
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <!-- Campo para Dirección de Envío -->
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección de Envío</label>
                        <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" required>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                
                    <!-- Métodos de Pago -->
                    <h4 class="mb-3">Método de Pago</h4>
                
                    <!-- Campo para Número de Tarjeta -->
                    <div class="mb-3">
                        <label for="tarjeta" class="form-label">Número de Tarjeta</label>
                        <input type="text" name="tarjeta" id="tarjeta" class="form-control @error('tarjeta') is-invalid @enderror" value="{{ old('tarjeta') }}" required placeholder="**** **** **** ****">
                        @error('tarjeta')
                            <div class="invalid-feedback">{{ "**** **** **** ****" }}</div>
                        @enderror
                    </div>
                
                    <!-- Campo para Fecha de Expiración -->
                    <div class="mb-3">
                        <label for="fecha_expiracion" class="form-label">Fecha de Expiración</label>
                        <input type="text" name="fecha_expiracion" id="fecha_expiracion" class="form-control @error('fecha_expiracion') is-invalid @enderror" value="{{ old('fecha_expiracion') }}" required placeholder="MM/AA">
                        @error('fecha_expiracion')
                            <div class="invalid-feedback">{{ "El formarto correcto debe ser MM/AA" }}</div>
                        @enderror
                    </div>
                
                    <!-- Campo para CVV -->
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" name="cvv" id="cvv" class="form-control @error('cvv') is-invalid @enderror" value="{{ old('cvv') }}" required placeholder="123">
                        @error('cvv')
                            <div class="invalid-feedback">{{ "El formato correcto debe ser 123" }}</div>
                        @enderror
                    </div>
        
                    {{-- Aquí pasamos la cantidad --}}
                    <input type="hidden" name="cantidad" value="{{ $cantidad }}">
                    <input type="hidden" name="total" value="{{ $total }}">

        
                    <!-- Botón de Confirmar Compra -->
                    <button type="submit" class="btn btn-primary w-100 mt-4">Confirmar Compra</button>
                </form>
            </div>
        </main>
        
         {{-- <h5>VAS A COMPRAR ALGO</h5>
            <p>Vas a comprar el producto {{$producto->nombre}}</p> --}}
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
        document.getElementById('compra-form').addEventListener('submit', function(event) {
            const nombre = document.getElementById('nombre').value.trim();
            const correo = document.getElementById('correo').value.trim();
            const direccion = document.getElementById('direccion').value.trim();
            const tarjeta = document.getElementById('tarjeta').value.trim();
            const fechaExpiracion = document.getElementById('fecha_expiracion').value.trim();
            const cvv = document.getElementById('cvv').value.trim();
            let valid = true;

            // Reiniciar mensajes de error
            document.querySelectorAll('.error').forEach(el => el.remove());

            // Validaciones
            if (!nombre) {
                valid = false;
                showError('nombre', 'El nombre completo es requerido.');
            } else if (nombre.length > 255) {
                valid = false;
                showError('nombre', 'El nombre completo no puede exceder los 255 caracteres.');
            }
            if (!correo) {
                valid = false;
                showError('correo', 'El correo electrónico es requerido.');
            } else if (!validateEmail(correo)) {
                valid = false;
                showError('correo', 'El formato del correo electrónico es incorrecto.');
            } else if (correo.length > 255) {
                valid = false;
                showError('correo', 'El correo electrónico no puede exceder los 255 caracteres.');
            }
            if (!direccion) {
                valid = false;
                showError('direccion', 'La dirección de envío es requerida.');
            } else if (direccion.length > 255) {
                valid = false;
                showError('direccion', 'La dirección de envío no puede exceder los 255 caracteres.');
            }
            if (!tarjeta) {
                valid = false;
                showError('tarjeta', 'El número de tarjeta es requerido.');
            } else if (!/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/.test(tarjeta)) {
                valid = false;
                showError('tarjeta', 'El formato debe ser **** **** **** ****');
            }
            if (!fechaExpiracion) {
                valid = false;
                showError('fecha_expiracion', 'La fecha de expiración es requerida.');
            } else if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(fechaExpiracion)) {
                valid = false;
                showError('fecha_expiracion', 'El formato correcto debe ser MM/AA');
            }
            if (!cvv) {
                valid = false;
                showError('cvv', 'El CVV es requerido');
            } else if (!/^\d{3}$/.test(cvv)) {
                valid = false;
                showError('cvv', 'El formato correcto debe ser 123');
            }

            if (!valid) {
                event.preventDefault(); // Evita que el formulario se envíe si hay errores
            }
        });

        function showError(field, message) {
            const input = document.getElementById(field);
            const error = document.createElement('div');
            error.className = 'error text-danger';
            error.innerText = message;
            input.parentNode.insertBefore(error, input.nextSibling);
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }
    </script>

    </body>
</html>
