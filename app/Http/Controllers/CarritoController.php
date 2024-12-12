<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Modelo del producto
use App\Models\Pedido;

use Validator;

use function Laravel\Prompts\alert;

class CarritoController extends Controller
{
    // Mostrar el carrito
    public function index()
    {
        // Obtener el carrito de la sesión (o un array vacío si no existe)
        $carrito = session()->get('carrito', []);

        return view('carrito.carrito', compact('carrito'));
    }

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
                "imagen" => $producto->imagen
            ];
        }


        // Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);


        // return redirect()->back()->with('exito', 'Producto añadido al carrito');
        return redirect()->route('tienda');


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

    public function mostrarResumen()
    {
        $carrito = session()->get('carrito', []);
        // Si el carrito está vacío, redirigir al usuario con un mensaje

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }

        // Calcular el total de la compra
        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];

        }
        // Pasar los datos del carrito y el total a la vista
        return view('carrito.comprarCarrito', compact('carrito', 'total'));
    }

    // Procesar la compra
    public function procesarCompra(Request $request)
    {
        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Si el carrito está vacío, redirigir al usuario con un mensaje
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
            'tarjeta' => 'required|max:20', // Validar que tenga 16 dígitos
            'fecha_expiracion' => 'required|regex:/^\d{2}\/\d{2}$/', // Validar formato MM/AA
            'cvv' => 'required|digits:3', // Validar que tenga 3 dígitos

        ]);

        $total = 0;
        foreach ($carrito as $id => $producto) {
            $total += $producto['precio'] * $producto['cantidad'];  // Calcula el total de la compra

            $prod = Producto::find($id);
            if ($prod) {
                if ($prod->stock < $producto['cantidad']) {
                    return redirect()->route('carrito.index')
                        ->with('error', 'No hay suficiente stock para el producto: ' . $producto['nombre']);
                }

                // Restar el stock del producto
                $prod->stock -= $producto['cantidad'];
                $prod->save();
            }
        }


        $pedido = Pedido::create([
            'nombre_cliente' => $request->input('nombre'),
            'email_cliente' => $request->input('correo'),
            'direccion' => $request->input('direccion'),
            'total' => $total,
            'pedido_estado_id' => 1, // Estado inicial: "Pendiente"
        ]);

        foreach ($carrito as $id => $producto) {
            $pedido->productos()->attach($id, [
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
            ]);
        }

        // Limpiar el carrito después de la compra
        session()->forget('carrito');

        return redirect()->route('home')->with('exito', 'Compra realizada con éxito. Total: ' . number_format($total, 2));
    }
}
