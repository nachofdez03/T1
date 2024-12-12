<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class DeleteCategoriaController extends Controller
{
    // Muestra la vista inicial con el menú de categorías
    public function showCategories()
    {
        $categorias = Categoria::all();
        return view('admin.deleteCategoria', compact('categorias'));
    }

    // Muestra las categorías seleccionadas
    public function showCategoriesByFilter(Request $request)
    {
        $categoria_id = $request->input('categoria_id');
        $categorias = Categoria::all();

        // Si se seleccionó una categoría, filtrar por esa categoría
        $categoriasFiltradas = $categoria_id ? Categoria::where('id', $categoria_id)->get() : Categoria::all();

        return view('admin.deleteCategoria', compact('categorias', 'categoriasFiltradas', 'categoria_id'));
    }

    // Elimina una categoría específica
    public function destroy($id)
    {
        // Buscar y eliminar la categoría
        $categoria = Categoria::findOrFail($id);

        // Eliminar productos asociados a la categoría 
        $categoria->productos()->delete(); // Si es necesario eliminar productos de la categoría

        // Eliminar la categoría
        $categoria->delete();

        return back()->with('success', 'Categoría eliminada correctamente');
    }
}
