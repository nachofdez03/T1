<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'categoria_id', 'cantidad_stock'];

    // Definimos un accessor para obtener el valor dinámico de 'disponible'
    public function getDisponibleAttribute()
    {
        return $this->cantidad_stock > 0; // Devuelve true si hay stock
    }

    // Relación con la categoría
    // Al definir la relación, puedes acceder fácilmente a los datos de la categoría asociada a un producto.
    // Las relaciones son una característica poderosa de Eloquent. Al definir la relación,
    // puedes utilizar métodos de Eloquent como with(), whereHas(), y otros, para trabajar con 
    // datos relacionados de manera más sencilla y eficaz.
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
