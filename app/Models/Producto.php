<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',          // Nombre del producto
        'descripcion',     // Descripción
        'precio',          // Precio
        'categoria_id',    // ID de la categoría
        'stock',           // Cantidad en stock
        'imagen'           // Ruta de la imagen
    ];




    public function categoria()
    {
        return $this->belongsTo(Categoria::class); // Un producto pertenece a una categoria
    }

    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'producto_carrito', 'producto_id', 'carrito_id');
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_producto')
            ->withPivot('cantidad', 'precio')
            ->withTimestamps();
    }

}
