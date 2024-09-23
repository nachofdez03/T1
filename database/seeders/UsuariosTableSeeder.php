<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verificar si el administrador ya existe
        if (!DB::table('usuarios')->where('correo', 'admin@example.com')->exists()) {
            DB::table('usuarios')->insert([
                'dni' => '00000000', // Cambia esto por un DNI válido
                'nombre' => 'Admin',  // Nombre del administrador
                'apellido' => 'Usuario', // Apellido del administrador
                'correo' => 'admin@example.com', // Correo del administrador
                'password' => Hash::make('admin123'), // Contraseña hasheada
                'rol' => 1, // Rol de administrador
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Crear usuarios de prueba usando la fábrica
        // Usuario::factory()->count(10)->create();
    }


}
