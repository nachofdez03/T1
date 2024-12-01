<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
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
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
             rel="stylesheet"
        />
        <link rel="icon" href="{{ asset('images/T1.png') }}" type="image/x-icon">


    </head>

    <body class="bodyLogin">

      <header>
        <div class="contenedor">
            <a href="{{ route('home')}}" class="image-link"><img src="{{ asset('images/T1_Logo.jpg') }}" alt=""></a>
            <!-- Botón de menú hamburguesa -->
            <button id="menu-toggle" class="hamburger-menu" aria-label="Abrir menú">
                ☰
            </button>

            <nav class="menu" id="mobile-menu">
                <button id="menu-close" class="close-button">✖</button>
                <a href="{{ route('carrito') }}" class="carrito-link">
                    <img src="{{ asset('images/Carrito.png') }}" alt="Carrito" id="carrito-icon">
                </a>
                <a href="https://lol.fandom.com/wiki/T1">Leaguepedia</a>
                <a href="{{ route('nosotros')}}">Sobre Nosotros</a>
                <a href="{{ route('tienda')}}">Tienda</a>
                
                @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                    <div class="dropdown">
                        <a href="#" id="adminDropdown" class="dropdown-toggle">Administración</a>
                        <div class="dropdown-menu" id="adminDropdownMenu" style="background-color: black">
                            <a class="dropdown-item" href="{{ route('createProducts') }}">Crear Productos</a>
                            <a class="dropdown-item" href="{{ route('deleteProducts') }}">Borrar Productos</a>
                            <a class="dropdown-item" href="{{ route('createCategoria') }}">Crear Categoría</a>
                            <a class="dropdown-item" href="{{ route('deleteCategorias') }}">Borrar Categoría</a>
                            <a class="dropdown-item" href="{{ route('updateStock') }}">Modificar Stock</a>
                            <a class="dropdown-item" href="{{ route('pedidos') }}">Pedidos</a>
                        </div>
                    </div>
                    @endif
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </nav>
        </div>
    </header>

        <main class="login" style="padding-bottom: 7em">
          <!-- Pills navs -->
          <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
                aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="false">Register</a>
            </li>
          </ul>

          <!-- Pills content -->
          <div class="tab-content" id="formLogin">
            <!-- Login Tab -->
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
              <form action="{{route('login.submit')}}" method="POST">
                @csrf

              
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="loginName" class="form-control" name="correoLogin" value="{{old('correoLogin')}}"/>
                  <label class="form-label" for="loginName">Email or username</label>
                </div>
            
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="loginPassword" class="form-control" name="passwordLogin"/>
                  <label class="form-label" for="loginPassword">Password</label>
                </div>

                @error('correoLogin')
                  <div class="text-danger">{{ $message }}</div> <!-- Muestra el error si existe -->
                 @enderror
          
                <!-- Remember me & Forgot password -->
                <div class="row mb-4">
                  <div class="col-md-6 d-flex justify-content-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                      <label class="form-check-label" for="loginCheck">Remember me</label>
                    </div>
                  </div>
                  <div class="col-md-6 d-flex justify-content-center">
                    <a href="#!">Forgot password?</a>
                  </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                <!-- Register redirect -->
                <div class="text-center">
                  <p>Not a member? <a href="#pills-register" data-bs-toggle="pill" role="tab" aria-controls="pills-register">Register</a></p>
                </div>
                
              
              </form>
            </div>

            <!-- Register Tab -->
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
              <form action="{{ route('register.submit')}}" method="POST">
                @csrf
                
                 <!-- DNI input -->
                 <div class="form-outline mb-4">
                  <input type="text" id="registerDNI" name="dni" class="form-control" value="{{old('dni')}}" />
                  <label class="form-label" for="registerDNI">DNI</label>
                 
                </div>
                @error('dni')
                  <div class="text-danger error-message mt-1">{{ $message }}</div> <!-- Muestra el error si existe -->
                @enderror
                
                

                <!-- Name input -->
                <div class="form-outline mb-4">
                  <input type="text" id="registerName" name="nombre" class="form-control" value="{{old('nombre')}}" required />
                  <label class="form-label" for="registerName">Name</label>
                  @error('nombre')
                    <div class="text-danger">{{ $message }}</div> <!-- Muestra el error si existe -->
                  @enderror
                </div>

                <!-- Username input -->
                <div class="form-outline mb-4">
                  <input type="text" id="registerLastName" name="apellido" class="form-control" value="{{old('apellido')}}" required/>
                  <label class="form-label" for="registerLastName">Last name</label>
                  @error('apellido')
                    <div class="text-danger">{{ $message }}</div> <!-- Muestra el error si existe -->
                  @enderror
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="registerEmail" name="correo" class="form-control" value="{{old('correo')}}" required/>
                  <label class="form-label" for="registerEmail">Email</label>
                  @error('correo')
                    <div class="text-danger">{{ $message }}</div> <!-- Muestra el error si existe -->
                  @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="registerPassword" class="form-control" name="password" value="{{old('password')}}" required/>
                  <label class="form-label" for="registerPassword">Password</label>
                  @error('password')
                    <div class="text-danger">{{ $message }}</div> <!-- Muestra el error si existe -->
                  @enderror
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="registerRepeatPassword" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" required />
                  <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                  @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div> <!-- Muestra el error si existe -->
                  @enderror
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                  <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked />
                  <label class="form-check-label" for="registerCheck">
                    I have read and agree to the terms
                  </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
              </form>
            </div>
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
        <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
        ></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
              // Verifica si hay errores en la sesión (esto lo maneja Laravel)
              @if ($errors->any())
                  var hasRegisterErrors = false;
      
                  // Itera sobre los errores para identificar si son del formulario de registro
                  @foreach ($errors->keys() as $field)
                      if (['dni', 'nombre', 'apellido', 'correo', 'password', 'password_confirmation'].includes('{{ $field }}')) {
                          hasRegisterErrors = true;
                      }
                  @endforeach
      
                  // Cambia a la pestaña de registro si hay errores de ese formulario
                  if (hasRegisterErrors) {
                      var registerTab = new bootstrap.Tab(document.querySelector('#tab-register'));
                      registerTab.show();
                  }
              @endif
          });
      </script>
        

    </body>
</html>

{{-- VALIDACION --}}
<script src="{{ asset('js/menuHamburguesa.js') }}"></script>

<script>
      document.getElementById('registro-form').addEventListener('submit', function(event) {
        const nombre = document.getElementById('nombre').value.trim();
        const correo = document.getElementById('correo').value.trim();
        const password = document.getElementById('password').value.trim();
        const passwordConfirm = document.getElementById('password_confirmation').value.trim();
        let valid = true;

        // Reiniciar mensajes de error
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
        if (!password) {
            valid = false;
            showError('password', 'La contraseña es requerida.');
        } else if (password.length < 8) {
            valid = false;
            showError('password', 'La contraseña debe tener al menos 8 caracteres.');
        }
        if (password !== passwordConfirm) {
            valid = false;
            showError('password_confirmation', 'Las contraseñas no coinciden.');
        }

        if (!valid) {
            event.preventDefault(); // Evita el envío si hay errores
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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


