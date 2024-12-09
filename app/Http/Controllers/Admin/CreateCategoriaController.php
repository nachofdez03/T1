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

        if ($request->hasFile('imagen')) {

            $imagen = $request->file('imagen');

            $imageName = str_replace(' ', '_', $request->nombre) . '.' . $imagen->getClientOriginalExtension();

            $imagePath = 'images/categorias/' . $imageName;

            $imagen->move(public_path('images/categorias'), $imageName);

            $categoria->imagen = $imagePath;
        }

        // Guardar la categoría en la base de datos
        $categoria->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('createCategoria')->with('success', 'Categoría creada exitosamente.');
    }
}
