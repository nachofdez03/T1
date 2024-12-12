<?php
/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;


class JugadorController extends Controller
{
    // Mostrar lista de jugadores
    public function index()
    {
        $jugadores = Jugador::all();
        return view('jugadores.index', compact('jugadores'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('jugadores.create');
    }

    // Guardar un nuevo jugador
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required',
            'Apodo' => 'required',
            'FechaNacimiento' => 'required|date',
            'Pais' => 'required',
            'Posicion' => 'required',
            'Logo' => 'nullable|image',
        ]);

        $jugador = new Jugador($request->all());
        $jugador->save();

        return redirect()->route('jugadores.index')
            ->with('success', 'Jugador creado con éxito.');
    }

    // Mostrar detalles de un jugador específico
    public function show($id)
    {
        $jugador = Jugador::findOrFail($id);
        return view('jugadores.show', compact('jugador'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $jugador = Jugador::findOrFail($id);
        return view('jugadores.edit', compact('jugador'));
    }

    // Actualizar un jugador existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required',
            'Apodo' => 'required',
            'FechaNacimiento' => 'required|date',
            'Pais' => 'required',
            'Posicion' => 'required',
            'Logo' => 'nullable|image',
        ]);

        $jugador = Jugador::findOrFail($id);
        $jugador->update($request->all());

        return redirect()->route('jugadores.index')
            ->with('success', 'Jugador actualizado con éxito.');
    }

    // Eliminar un jugador
    public function destroy($id)
    {
        $jugador = Jugador::findOrFail($id);
        $jugador->delete();

        return redirect()->route('jugadores.index')
            ->with('success', 'Jugador eliminado con éxito.');
    }
}
