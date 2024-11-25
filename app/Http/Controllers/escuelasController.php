<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class escuelasController extends Controller
{
    /**
     * Mostrar la lista de escuelas.
     */
    public function index()
    {
        $escuelas = Escuela::all();
        return view('escuelas.index', compact('escuelas'));
    }

    /**
     * Mostrar el formulario para crear una nueva escuela.
     */
    public function create()
    {
        return view('escuelas.create');
    }

    /**
     * Guardar una nueva escuela en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreEscuela' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'logoEscuela' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('logoEscuela')) {
            $validatedData['logoEscuela'] = $request->file('logoEscuela')->store('logos', 'public');
        }

        Escuela::create($validatedData);

        return redirect()->route('escuelas.index')
        ->with('mensaje', 'Escuela creada con éxito.')
        ->with('icono','success');
    }

    /**
     * Mostrar los detalles de una escuela específica.
     */
    public function show(Escuela $escuela)
    {
        return view('escuelas.show', compact('escuela'));
    }

    /**
     * Mostrar el formulario para editar una escuela existente.
     */
    public function edit(Escuela $escuela)
    {
        return view('escuelas.edit', compact('escuela'));
    }

    /**
     * Actualizar una escuela en la base de datos.
     */
    public function update(Request $request, Escuela $escuela)
    {
        $validatedData = $request->validate([
            'nombreEscuela' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'logoEscuela' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logoEscuela')) {
            // Eliminar el logo antiguo si existe
            if ($escuela->logoEscuela) {
                Storage::disk('public')->delete($escuela->logoEscuela);
            }
            $validatedData['logoEscuela'] = $request->file('logoEscuela')->store('logos', 'public');
        }

        $escuela->update($validatedData);

        return redirect()->route('escuelas.index')
        ->with('mensaje', 'Escuela actualizada con éxito.')
        ->with('icono','success');
    }

    /**
     * Eliminar una escuela de la base de datos.
     */
    public function destroy(Escuela $escuela)
    {
        if ($escuela->logoEscuela) {
            Storage::disk('public')->delete($escuela->logoEscuela);
        }

        $escuela->delete();

        return redirect()->route('escuelas.index')
        ->with('mensaje', 'Escuela eliminada con éxito.')
        ->with('icono','success');
    }
}
