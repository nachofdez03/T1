<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Compra</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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


    <main class="container my-5">
        <h2 class="text-center mb-4">Resumen de Compra</h2>

        <!-- Mostrar el resumen de los productos -->
        @foreach ($carrito as $id => $producto)
        <div class="imagen-container container d-flex justify-content-center pdt-1">
            <div class="">
                <img src="{{asset($producto['imagen'])}} " alt="{{ $producto['nombre'] }}" class="img-fluid" style="  max-width: 70%;">
            </div>
            <div class="text-center informacion informacionCompra">
                <h5>{{ $producto['nombre'] }}</h5>
                <p>Precio unitario: ${{ number_format($producto['precio'], 2) }}</p>
                <p>Cantidad: {{ $producto['cantidad'] }}</p>
                <p><strong>Total: ${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</strong></p>
            </div>
        </div>
        @endforeach

        <!-- Mostrar el total de la compra -->
        <h4 class="text-center" style="margin-bottom: 3em; margin-top:2em;">Total: ${{ number_format($total, 2) }}</h4>

         <!-- Formulario de Datos del Cliente -->
         <div class="mt-5" style="padding-top: 4em; margin-bottom: 10em"> <!-- Margen superior para separar del producto -->
            <form id="compra-form" action="{{ route('procesarCompra') }}" method="POST" class="formulario-compacto">
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
                <!-- Botón de Confirmar Compra -->
                <button type="submit" class="btn btn-primary w-100 mt-4">Confirmar Compra</button>
            </form>
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
    
    <script>
        document.getElementById('compra-form').addEventListener('submit', function(event) {
            const nombre = document.getElementById('nombre').value.trim();
            const correo = document.getElementById('correo').value.trim();
            const direccion = document.getElementById('direccion').value.trim();
            const tarjeta = document.getElementById('tarjeta').value.trim();
            const fechaExpiracion = document.getElementById('fecha_expiracion').value.trim();
            const cvv = document.getElementById('cvv').value.trim();
            let valid = true;

            document.querySelectorAll('.error').forEach(el => el.remove());

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
            }
            if (!direccion) {
                valid = false;
                showError('direccion', 'La dirección de envío es requerida.');
            }
            if (!tarjeta || !/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/.test(tarjeta)) {
                valid = false;
                showError('tarjeta', 'El número de tarjeta debe ser válido.');
            }
            if (!fechaExpiracion || !/^(0[1-9]|1[0-2])\/\d{2}$/.test(fechaExpiracion)) {
                valid = false;
                showError('fecha_expiracion', 'Fecha inválida.');
            }
            if (!cvv || !/^\d{3}$/.test(cvv)) {
                valid = false;
                showError('cvv', 'CVV inválido.');
            }

            if (!valid) event.preventDefault();
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

        document.addEventListener("DOMContentLoaded", function() {
            const dropdownToggle = document.getElementById("adminDropdown");
            const dropdownMenu = document.getElementById("adminDropdownMenu");

            dropdownToggle.addEventListener("click", function(event) {
                event.preventDefault();
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function(event) {
                if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = "none";
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
