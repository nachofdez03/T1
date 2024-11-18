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

    // Definimos un accessor para obtener el valor dinámico de 'disponible'


    // Relación con la categoría
    // Al definir la relación, puedes acceder fácilmente a los datos de la categoría asociada a un producto.
    // Las relaciones son una característica poderosa de Eloquent. Al definir la relación,
    // puedes utilizar métodos de Eloquent como with(), whereHas(), y otros, para trabajar con 
    // datos relacionados de manera más sencilla y eficaz.
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
            ->withPivot('cantidad', 'precio') // Campos adicionales de la tabla intermedia
            ->withTimestamps();
    }

}
