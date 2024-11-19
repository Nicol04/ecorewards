<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorium;

class categoriaController extends Controller
{
    public function index(Request $request){
        // Capturamos el térmno de búsqueda del request
        $search = $request->input('search');

        // Si hay un término de búsqueda, filtra las categías
        $categorias = Categorium::when($search, function ($query, $search){
            $query->where('nombreCategoria', 'like', "%{$search}%")
            ->orWhere('descripcion', 'like',"%{$search}");
        })->get();
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:40',
            'descripcion' => 'nullable|string|max:2005',            
        ]);

        // Guardamos en base de datos
        Categorium::created($validatedData);

        // Redigirimos con mensaje de éxito
        return redirect('categorias.index')->with('success', 'Categoría creata exitosamente');
    }

    public function show(Categorium $categorium)
    {
        return view('categorias.show', compact('categorias')); 
    } 

    public function edit(Categorium $categorium)
    {
        return view('categorias.edit', compact('categorias'));
    }

    public function update(Categorium $categorium, Request $request){
        // Validamos los datos
        $validateData = $request->validate([
            'nombreCategoria' => 'string|required|max:40',
            'descripcion' => 'string|max:2005',
        ]);

        // Actualizar la categoría
        $categorium->update($validateData);

        //Redirigir con mensaje de éxito
        return redirect()->route('categoria.index')->with('succes', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categorium $categorium)
    {
        $categorium->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}

