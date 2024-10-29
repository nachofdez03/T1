<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Carrito extends Model
{
    use HasFactory;

    public function Carrito()
    {
        return $this->belongsTo(Carrito::class);
        // Producto::class: Indica que esta relación está vinculada al modelo Producto.

    }

    // Relación con Talla, cada registro en la tabla productos_tallas_stock pertenece a una única talla.
    public function Producto()
    {
        return $this->belongsTo(Producto::class);
    }

}

