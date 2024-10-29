<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';


    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id'); // Un carrito pertenece a un usuario
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_carrito', 'carrito_id', 'producto_id');
    }




}
