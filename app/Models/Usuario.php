<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios"; // Nombre de la tabla en la BBDD


    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'correo',
        'password',
    ];

    /**
     * Atributos que deben estar ocultos para arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

