<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Importamos la fachada Hash, gracias a ella obtendremos las funcionalidades hash como encriptar


class AuthController extends Controller
{
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

        // Redireccionar o devolver una respuesta
        return redirect()->route('login')->with('success', 'Usuario registrado exitosamente');
    }
}
