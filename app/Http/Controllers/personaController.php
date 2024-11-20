<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class personaController extends Controller
{
    /**
     * Mostrar una lista de personas, con la opción de filtrar por colegio.
     */
    public function index(Request $request)
    {
        $query = Persona::query();

        // Filtrar por colegio
        if ($request->filled('colegio')) {
            $query->whereHas('escuelas', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->input('colegio') . '%');
            });
        }

        $personas = $query->get();

        return view('personas.index', compact('personas'));
    }

    /**
     * Mostrar el formulario para crear una nueva persona.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Guardar una nueva persona en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idusuario' => 'required|exists:usuarios,idusuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fechaNacimiento' => 'required|date',
            'direccion' => 'required|string',
            'telefono' => 'required|string|max:15',
            'genero' => 'required|string|in:masculino,femenino',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Subir la foto si existe
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Persona::create($validatedData);

        return redirect()->route('personas.index')->with('success', 'Persona creada exitosamente.');
    }
}
