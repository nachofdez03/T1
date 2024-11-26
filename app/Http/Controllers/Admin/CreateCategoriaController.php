<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CreateCategoriaController extends Controller
{
    // Mostrar el formulario para crear una categoría
    public function showForm()
    {
        return view('admin.createCategoria');
    }

    // Guardar la nueva categoría
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'image|nullable|max:2048', // Validación de la imagen
        ]);

        // Crear la nueva categoría
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;

        // Manejar la carga de la imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de la imagen
            $imagen = $request->file('imagen');
            // Generar un nombre único para la imagen
            $imageName = str_replace(' ', '_', $request->nombre) . '.' . $imagen->getClientOriginalExtension();
            // Especificar la ruta donde se guardará la imagen
            $imagePath = 'images/categorias/' . $imageName;

            // Mover la imagen a la carpeta de imágenes públicas
            $imagen->move(public_path('images/categorias'), $imageName);

            // Guardar la ruta de la imagen en la categoría
            $categoria->imagen = $imagePath;
        }

        // Guardar la categoría en la base de datos
        $categoria->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('createCategoria')->with('success', 'Categoría creada exitosamente.');
    }
}
