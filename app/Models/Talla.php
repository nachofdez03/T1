<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación con Producto, una talla puede estar asociada a varios productos, MUCHOS A MUCHOS 
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_talla_stock')
            ->withPivot('cantidad_stock')
            ->withTimestamps();
    }
}
