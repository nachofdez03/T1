<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria; // Importa el modelo de Categoría
use App\Models\Producto;

class UpdateStockController extends Controller
{
    // Muestra la vista con el menú desplegable de categorías
    public function showCategories()
    {
        $categorias = Categoria::all();
        return view('admin.updateStock', compact('categorias'));
    }

    // Muestra los productos de una categoría seleccionada
    public function showProductsByCategory(Request $request)
    {
        $categoria_id = $request->input('categoria_id');
        $productos = Producto::where('categoria_id', $categoria_id)->get();
        $categorias = Categoria::all();

        return view('admin.updateStock', compact('productos', 'categorias', 'categoria_id'));
    }

    // Actualiza el stock de un producto específico
    public function updateStock(Request $request, Producto $producto)
    {
        $nuevoStock = $request->input('nuevo_stock');
        $producto->stock = $nuevoStock;
        $producto->save();

        return back()->with('success', 'Stock actualizado correctamente');
    }
}
