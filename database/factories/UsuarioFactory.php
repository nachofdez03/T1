<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'dni' => $this->faker->unique()->numerify('########'),
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'correo' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Contraseña por defecto
            'rol' => 0, // Rol por defecto
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
