<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

/*
// Obtener todos los productos
$productos = Producto::all();

// Obtener productos de una categoría específica
$productosCategoria = Producto::where('categoria_id', 1)->get();

// Obtener el primer producto disponible
$primerProducto = Producto::where('disponible', true)->first();

// Obtener el producto con id 1
$productoEspecifico = Producto::find(1);

// Obtener una lista de nombres de productos
$nombresProductos = Producto::pluck('nombre');

// Obtener columnas especificas
$productos = Producto::select('id', 'nombre', 'precio')->get();

// Paginacion
$productos = Producto::paginate(10); // Obtiene 10 productos por página
*/


class TiendaController extends Controller
{

    public function index(Request $request)
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Lo definimos ya que la primera vez no hay ninguna categoria seleccionada por defecto y da error
        $categoriaSeleccionada = null;
        $categoriaSeleccionadaNombre = null;


        // Verifica si existe un campo llamado categoria_id en la solicitud / Esto se ejecuta si 'categoria_id' tiene un valor que no es vacío (ni "", ni null, ni 0)
        if ($request->has('categoria_id') && !empty($request->input('categoria_id'))) {
            $categoria_id = $request->input('categoria_id');
            $categoriaSeleccionada = $categoria_id; // Esto lo hacemos para saber que categoria hemos seleccionado

            // Ahora vamos a coger los productos que tengan esa categoria
            $productos = Producto::where('categoria_id', $categoria_id)->get();
            $categoriaSeleccionadaNombre = Categoria::where('id', $categoria_id)->get()->first();

            // Si no la hay obtenemos los productos de manera aleatoria lo que quiere decir por defecto cuando se accede a la pagina
        } else {
            $productos = Producto::inRandomOrder()->take(10)->get();
        }

        // Devolver la vista con las categorías y productos
        return view('tienda.tienda', compact('categorias', 'productos', 'categoriaSeleccionada', 'categoriaSeleccionadaNombre'));
    }
}
