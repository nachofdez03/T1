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

        $estadoFiltro = $request->input(key: 'estado');

        $pedidos = Pedido::with(relations: 'productos')
            ->when($estadoFiltro, function ($query) use ($estadoFiltro) {
                $query->where('pedido_estado_id', $estadoFiltro);
            })
            ->get();

        return view('tienda.pedidos', compact('pedidos', 'estadoFiltro', 'estados'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'nuevo_estado' => 'required|exists:pedido_estado,id',
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->pedido_estado_id = $request->input('nuevo_estado');
        $pedido->save();

        return redirect()->route('pedidos')->with('success', 'El estado del pedido ha sido actualizado.');
    }


}
