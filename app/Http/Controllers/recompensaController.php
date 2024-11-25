<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Recompensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class recompensaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categorias = Categorium::all();
        Log::info('Listando recompensas con filtros.', $request->all());

        // Variable para guardar la consulta SQL
        $query = Recompensa::query();

        // Filtrar por categoría
        if ($request->filled('idcategoria')) {
            $query->where('idcategoria', $request->input('idcategoria'));
        }

        // Filtrar por nombre de la recompensa
        if ($request->filled('nombre')) {
            $query->where('nombreRecompensa', 'like', '%' . $request->input('nombre') . '%');
        }

        // Filtrar por puntos requeridos (exacto o rango)
        if ($request->filled('puntosRequeridos')) {
            $query->where('puntosRequeridos', $request->input('puntosRequeridos'));
        }
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

        $recompensas = $query->get();
        return view('recompensas.index', compact('recompensas', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categorium::all();
        return view('recompensas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreRecompensa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'puntosRequeridos' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|string|max:255',
            'idcategoria' => 'required|integer|exists:categoria,idcategoria',
        ]);

        if ($validator->fails()) {
            Log::error('Error al crear recompensa.', ['errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recompensa = Recompensa::create($request->all());
        Log::info('Recompensa creada exitosamente.', ['idRecompensa' => $recompensa->idRecompensa]);

        return redirect()->route('recompensas.index')
        ->with('mensaje', 'Recompensa creada correctamente.')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recompensa $recompensa)
    {
        return view('recompensas.show', compact('recompensa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recompensa $recompensa)
    {
        $categorias = Categorium::all();
        return view('recompensas.edit', compact('recompensa', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recompensa $recompensa)
    {
        $validator = Validator::make($request->all(), [
            'nombreRecompensa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'puntosRequeridos' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|string|max:255',
            'idcategoria' => 'required|integer|exists:categoria,idcategoria',
        ]);

        if ($validator->fails()) {
            Log::error('Error al actualizar recompensa.', ['idRecompensa' => $recompensa->idRecompensa, 'errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recompensa->update($request->all());
        Log::info('Recompensa actualizada exitosamente.', ['idRecompensa' => $recompensa->idRecompensa]);

        return redirect()->route('recompensas.index')
        ->with('success', 'Recompensa actualizada correctamente.')
        ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recompensa $recompensa)
    {
        $recompensa->delete();
        Log::info('Recompensa eliminada exitosamente.', ['idRecompensa' => $recompensa->idRecompensa]);

        return redirect()->route('recompensas.index')
        ->with('mensaje', 'Recompensa eliminada correctamente.')
        ->with('icono','success');
    }
}
