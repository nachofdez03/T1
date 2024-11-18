<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoEstado;



class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $estados = PedidoEstado::all();

        // Obtener el estado del filtro (si no hay, será null)
        $estadoFiltro = $request->input(key: 'estado');

        // Consultar los pedidos según el estado (si no hay filtro, trae todos)
        $pedidos = Pedido::with(relations: 'productos')
            ->when($estadoFiltro, function ($query) use ($estadoFiltro) {
                $query->where('pedido_estado_id', $estadoFiltro);
            })
            ->get();

        // Pasar el estado seleccionado y los pedidos a la vista
        return view('tienda.pedidos', compact('pedidos', 'estadoFiltro', 'estados'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'nuevo_estado' => 'required|exists:pedido_estado,id',
        ]);

        // Encuentra el pedido por ID
        $pedido = Pedido::findOrFail($id);
        $pedido->pedido_estado_id = $request->input('nuevo_estado');
        $pedido->save();

        // Redirige al usuario de vuelta con un mensaje de éxito
        return redirect()->route('pedidos')->with('success', 'El estado del pedido ha sido actualizado.');
    }


}
