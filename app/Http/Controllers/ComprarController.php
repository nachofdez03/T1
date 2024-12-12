<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Pedido;



use Illuminate\Http\Request;

class ComprarController extends Controller
{

    public function comprar(Request $request, $id)
    {

        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($id);  // Solo se usa con ID's
        $cantidad = $request->input('cantidad');
        $total = $producto->precio * $cantidad;
        return view("tienda.comprar", compact('producto', 'cantidad', 'total'));

    }

    public function confirmar(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
            'tarjeta' => 'required|string|max:20',
            'fecha_expiracion' => 'required|string|max:5',
            'cvv' => 'required|string|max:3',
        ]);

        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);

        // Confirmar la compra y actualizar el stock
        $producto->stock -= $request->cantidad;
        $producto->save();

        // Crear el pedido en la tabla `pedidos`
        $pedido = Pedido::create([
            'nombre_cliente' => $request->input('nombre'),
            'email_cliente' => $request->input('correo'),
            'direccion' => $request->input('direccion'),
            'total' => $request->input(key: 'total'),
            'pedido_estado_id' => 1, // Estado inicial: "Pendiente"
        ]);

        // Registrar el producto en la tabla intermedia 
        $pedido->productos()->attach($producto->id, [
            'cantidad' => $request->input(key: 'cantidad'),
            'precio' => $producto->precio,
        ]);

        return redirect()->route('home')->with('success');


        ;
    }

}
