<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Title</title>
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

        

    </head>

    <body class="bodyLogin">

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

        <main class="login">
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
          <div class="tab-content">
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
        <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
        ></script>
        

    </body>
</html>


{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
      // Verifica si hay errores en la sesión (esto lo maneja Laravel)
      @if ($errors->any())
          // Activa la pestaña de registro.
          var registerTab = new bootstrap.Tab(document.querySelector('#tab-register'));
          registerTab.show();
      @endif
  });
</script> --}}


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


