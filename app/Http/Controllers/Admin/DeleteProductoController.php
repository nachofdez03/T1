<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;


class DeleteProductoController extends Controller
{
    // Muestra la vista inicial con el menú de categorías
    public function showCategories()
    {
        $categorias = Categoria::all();
        return view('admin.deleteProducto', compact('categorias'));
    }

    // Muestra los productos de una categoría seleccionada
    public function showProductsByCategory(Request $request)
    {
        $categoria_id = $request->input('categoria_id');
        $categorias = Categoria::all();

        // Verificar si se seleccionó una categoría y obtener los productos
        $productos = $categoria_id ? Producto::where('categoria_id', $categoria_id)->get() : [];

        // Pasamos la categoría seleccionada para mantener el valor en el menú desplegable
        return view('admin.deleteProducto', compact('productos', 'categorias', 'categoria_id'));
    }

    // Elimina un producto específico
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return back()->with('success', 'Producto eliminado correctamente');
    }

}
