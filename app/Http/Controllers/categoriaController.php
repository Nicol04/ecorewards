<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorium;

class categoriaController extends Controller
{
    public function index(Request $request)
    {
        // Capturamos el término de búsqueda del request
        $search = $request->input('search');

        // Si hay un término de búsqueda, filtra las categorías
        $categorias = Categorium::when($search, function ($query, $search) {
            $query->where('nombreCategoria', 'like', "%{$search}%")
                ->orWhere('descripcion', 'like', "%{$search}%");
        })->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombreCategoria' => 'required|string|max:40',
            'descripcion' => 'nullable|string|max:2005',
        ]);

        // Guardamos la categoría en base de datos
        Categorium::create($validatedData);

        // Redirigimos con mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente');
    }

    public function show(Categorium $categorium)
    {
        return view('categorias.show', compact('categorium'));
    }

    public function edit(Categorium $categorium)
    {
        return view('categorias.edit', compact('categorium'));
    }

    public function update(Categorium $categorium, Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombreCategoria' => 'required|string|max:40',
            'descripcion' => 'nullable|string|max:2005',
        ]);

        // Actualizar la categoría
        $categorium->update($validatedData);

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy(Categorium $categorium)
    {
        // Eliminar la categoría
        $categorium->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente');
    }
}
