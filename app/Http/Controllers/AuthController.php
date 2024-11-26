<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importamos la fachada Hash, gracias a ella obtendremos las funcionalidades hash como encriptar
use Illuminate\Support\Facades\Auth;



// Usuario: Es tu modelo Eloquent que representa la tabla usuarios en la base de datos.

// Auth::login(): Este método inicia la sesión de un usuario autenticado. 
// No pertenece a tu modelo de usuario (en este caso, Usuario), sino a la facade Auth,
class AuthController extends Controller
{
    // El objeto $request contiene los datos que se enviaron desde el formulario a traves del HTTP
    // Método para registrar usuarios
    public function register(Request $request)
    {
        // Validar los datos de entrada
        // Usando el validate ( validando ), si hubiera un error, estos pasan automaticamente a la vista
        // y @error se encarga de mostrarlos
        $validatedData = $request->validate([
            'dni' => 'required|max:9|unique:usuarios,dni',
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'correo' => 'required|email|max:100|unique:usuarios,correo',
            'password' => 'required|min:8|confirmed', // La regla "confirmed" validará que coincida con "password_confirmation"
        ]);

        // Crear un nuevo usuario en la base de datos
        $usuario = Usuario::create([
            'dni' => $validatedData['dni'],
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'correo' => $validatedData['correo'],
            'password' => Hash::make($validatedData['password']), // Encriptar la contraseña
        ]);
        Auth::login($usuario);


        // Redireccionar o devolver una respuesta
        return redirect()->route('home')->with('success', 'Usuario registrado exitosamente');
    }

    // Método para manejar el inicio de sesión

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->validate([
            'correoLogin' => 'required|email',
            'passwordLogin' => 'required',
        ]);

        // Buscar al usuario por correo
        // where: Este método de Eloquent construye una consulta para buscar registros 
        // en la tabla usuarios donde el campo correo sea igual al valor de $credentials['correo'].
        $usuario = Usuario::where('correo', $credentials['correoLogin'])->first();
        // SELECT * FROM usuarios WHERE correo = '$credentials['correo']' LIMIT 1;


        // Intentar iniciar sesión con las credenciales proporcionadas
        if ($usuario && Hash::check($credentials['passwordLogin'], $usuario->password)) {
            // Autenticar al usuario
            Auth::login($usuario);
            // Redirigir al usuario a la página de inicio
            return redirect()->route('home')->with('success', 'Inicio de sesión exitoso');
        }

        // Si las credenciales no son correctas, devolver un mensaje de error
        return back()->withErrors([
            'correoLogin' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('correoLogin');
    }

    // Método para cerrar sesión (logout)
    public function logout()
    {
        Auth::logout();
        // Redirigir al usuario a la página previa en la que estaba
        return redirect()->back()->with('success', 'Has cerrado sesión exitosamente.');
        // return redirect()->route('login')->with('success', 'Has cerrado sesión exitosamente.');
    }

}
