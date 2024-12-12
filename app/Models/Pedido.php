<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cliente',
        'email_cliente',
        'direccion',
        'total',
        'pedido_estado_id'
    ];

    // Relación con la tabla pedido_estado
    public function estado()
    {
        return $this->belongsTo(PedidoEstado::class, 'pedido_estado_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_producto')
            ->withPivot('cantidad', 'precio') // Campos adicionales de la tabla intermedia
            ->withTimestamps();
    }
}
