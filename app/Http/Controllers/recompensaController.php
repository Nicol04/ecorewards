<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Recompensa;
use App\Models\recompensaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class recompensaController extends Controller
{
    public function index(request $request)
    {
        // Variable para guardar la consulta SQL
        $query = Recompensa::query();
        // Filtrar por categoría
        if ($request->filled('idcategoria')) {

            // Con select de name = 'idcategoria
            $query->where('idcategoria', $request->input('idcategoria'));
        }

        // Filtrar por nombre de la recompensa
        if ($request->filled('nombre')) {
            $query->where('nombreRecompensa', 'like', '%' . $request->input('nombre') . '%');
        }

        // Filtrar por puntos requeridos
        if ($request->filled('puntos Requeridos')) {
            $query->where('puntosRequeridos', $request->input('puntos Requeridos'));
        }

        // Filtrar por puntos requeridos (rango o exacto)
        if ($request->filled('puntosMin')) {
            $query->where('puntosRequeridos', '>=', $request->input('puntosMin'));
        }
        if ($request->filled('puntosMax')) {
            $query->where('puntosRequeridos', '<=', $request->input('puntosMax'));
        }

        // Filtrar por descripción
        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }

        // Filtrar por nombre de la categoría
        if ($request->filled('nombreCategoria')) {
            $query->whereHas('categorium', function ($q) use ($request) {
                $q->where('nombreCategoria', 'like', '%' . $request->input('nombreCategoria') . '%');
            });
        }

        $recompensa = $query->get();
        return view('recompensas.index', compact('recompensas'));
    }
    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'nombreRecompensa' => 'unique|string|max:50',
            'descripcion' => 'nullable|string',
            'puntosRequeridos' => 'required|integer|min:1',
            'imagen' => 'nullable|image|max:2049', // Validar que sea una image
            'idcategoria' => 'required|exists:categoria, idCategria',
        ]);

        try{
            // Procesar image
            if($request->hasFile('image')) {
                $validatedData['imagen'] = file_get_contents($request->file('imagen')->getRealPath());
            }

            Recompensa::create($validatedData);
            return redirect()->route('recompensas.index')->with('success', 'Recompensa creada exitosamente.');
        }
        catch (\Exception $e){
            return redirect()->route('recompensas.index')->with('error', 'Error al crear la recompensa: ' . $e->getMessage());
        }

    }

    public function show(Recompensa $recompensa) 
    {
        return view('recompensa.show', compact('recompensa'));
    }

    public function update(Request $request, Recompensa $recompensa) 
    {
        $validatedData = $request->validate([
            'nombreRecompensa' => 'unique|string|max:50',
            'descripcion' => 'nullable|string',
            'puntosRequeridos' => 'required|integer|min:1',
            'imagen' => 'nullable|image|max:2049', // Validar que sea una image
            'idcategoria' => 'required|exists:categoria, idCategria',
        ]);

        $recompensa->update($validatedData);

        return redirect()->route('recompensas.index')->with('success', 'Recompensa actualizada exitosamente');
    }

    public function destroy(Recompensa $recompensa) {
        // Elminar la recompensa
        $recompensa->delete();

        return redirect()->route('categorias.index');
    }
}
