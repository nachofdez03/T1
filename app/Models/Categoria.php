<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen']; // Propiedad que se puede llenar masivamente

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class); // Relación uno a muchos
        // Una categoría puede tener muchos productos 
        // (es decir, puede haber varios productos que referencien a la misma categoría).
    }
}
