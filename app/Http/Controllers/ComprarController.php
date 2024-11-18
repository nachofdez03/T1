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

        // Verificar si hay suficiente stock
        // if ($producto->stock < $request->cantidad) {
        //     return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.']);
        // }

        // Confirmar la compra y actualizar el stock
        $producto->stock -= $request->cantidad;
        $producto->save();

        // Crear el pedido en la tabla `pedidos`
        $pedido = Pedido::create([
            'nombre_cliente' => $request->input('nombre'),
            'email_cliente' => $request->input('correo'),
            'direccion' => $request->input('direccion'),
            'total' => $request->input('total'),
            'pedido_estado_id' => 1, // Estado inicial: "Pendiente"
        ]);

        // El método attach se utiliza en relaciones de tipo muchos a muchos en Laravel para asociar registros en tablas intermedias
        // Registrar el producto en la tabla intermedia `pedido_producto`
        $pedido->productos()->attach($producto->id, [
            'cantidad' => $request->input('cantidad'),
            'precio' => $producto->precio,
        ]);


        return redirect()->route('home')->with('success');




        // Redireccionar al usuario a una página de confirmación o mostrar un mensaje de éxito
        // return redirect()->route('compra.confirmada')->with('success', 'Compra confirmada con éxito.');
    }

}
