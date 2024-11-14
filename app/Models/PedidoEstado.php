<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoEstado extends Model
{
    use HasFactory;

    protected $table = 'pedido_estado';

    protected $fillable = ['nombre'];

    // Relación inversa con `Pedido`
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'pedido_estado_id');
    }
}
