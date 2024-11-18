<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Modelo del producto

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        // Obtener el carrito de la sesión (o un array vacío si no existe)
        $carrito = session()->get('carrito', []);
        // Obtener el carrito de la sesión (o un array vacío si no existe)
        $carrito = session()->get('carrito', []);

        return view('carrito.carrito', compact('carrito'));
    }

    // Añadir un producto al carrito
    // Añadir un producto al carrito
    public function agregar(Request $request, $id)
    {
        $producto = Producto::findOrFail($id); // Validar que el producto exista

        // Obtener el carrito actual de la sesión
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, aumentar su cantidad
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            // Si no está, añadirlo con cantidad inicial de 1
            $carrito[$id] = [
                "nombre" => $producto->nombre,
                "precio" => $producto->precio,
                "cantidad" => 1,
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        return redirect()->back()->with('exito', 'Producto añadido al carrito');
    }


    // Actualizar la cantidad de un producto
    public function actualizar(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('exito', 'Cantidad actualizada');
    }

    // Eliminar un producto del carrito
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('exito', 'Producto eliminado del carrito');
    }

    // Vaciar el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->back()->with('exito', 'Carrito vaciado');
    }
}
