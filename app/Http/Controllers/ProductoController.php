<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class ProductoController extends Controller
{
    public function detalleProducto($id)
    {
        // $producto = Producto::where('id', $id)->first(); //  necesitas escribir más código para manejar casos donde el registro no se encuentra
        $producto = Producto::findOrFail($id);  // Solo se usa con ID's

        //dd($producto->nombre);
        return view("tienda.producto", compact('producto'));


    }


}

// echo "<script>alert('¡Hola! Esta es una alerta desde PHP.');</script>";
