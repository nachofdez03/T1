<?php

/*Resumen:

Controladores: Coloca la lógica CRUD para manejar las solicitudes y manipular datos.
Rutas: Para ejemplos simples, puedes definir lógica directamente en las rutas.
Vistas: Para mostrar los datos que vienen del controlador. */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'jugadores';

    // Si el nombre del campo de la clave primaria no es 'id', se debe especificar:
    protected $primaryKey = 'JugadorId';

    // Los campos que se pueden llenar de manera masiva
    protected $fillable = [
        'Nombre',
        'Apodo',
        'FechaNacimiento',
        'Pais',
        'Posicion',
        'Logo',
    ];

    // Opcional: si no usas timestamps (created_at y updated_at), desactívalos
    // public $timestamps = false;
}
