<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar Model por Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

// Modelo representa al usuario en tu aplicacion
class Usuario extends Authenticatable // Extender de Authenticatable en vez de Model
{
    use HasFactory;

    protected $table = "usuarios"; // Nombre de la tabla en la BBDD


    // Atributos que se pueden asignar masivamente
    // el fillable solo se utiliza para CREATE o UPDATE
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

    public function isAdmin()
    {

        return $this->rol === 1;
    }

    // Relación Usuario - Carrito
    public function carrito()
    {

        return $this->hasOne(Carrito::class); // Un usuario tiene un carrito
    }

}

