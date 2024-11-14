<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria; // Importa el modelo de Categoría
use App\Models\Producto;



class CreateProductoController extends Controller
{
    public function showForm()
    {
        $categorias = Categoria::all();

        return view('admin.createProducto', compact('categorias'));
    }

    // Usa create() cuando quieras insertar datos de forma rápida y todos los atributos ya están listos.
    // Usa save() cuando necesitas realizar ajustes o procesos adicionales en la instancia del modelo antes de guardarla.
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|integer',
            'imagen' => 'image|nullable|max:2048',
        ]);

        // Crear una instancia de Producto  
        $producto = new Producto();
        $producto->nombre = $request->nombre; // Correcto
        $producto->descripcion = $request->descripcion; // Correcto
        $producto->precio = $request->precio; // Correcto
        $producto->categoria_id = $request->categoria_id; // Correcto
        $producto->stock = $request->stock; // Correcto

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imageName = str_replace(' ', '_', $request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $imagePath = 'images/' . $imageName;

            // Mover la imagen a la carpeta deseada
            $imagen->move(public_path('images'), $imageName);
            $producto->imagen = $imagePath;
        }

        // Almacenar el producto en la base de datos
        $producto->save();

        // Redirigir con mensaje de éxito (opcional)
        // return redirect()->route('admin.products.index')->with('success', 'Producto creado exitosamente');
    }
}
