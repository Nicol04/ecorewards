<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class materialController extends Controller
{
    /**
     * Display a listing of the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Log::info('Fetching all materials');
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new material.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreMaterial' => 'required|string|max:255',
            'precioKg' => 'required|numeric|min:0',
        ]);

        Log::info('Creating new material', $validatedData);
        $material = Material::create($validatedData);

        Log::info('Material created successfully', ['id' => $material->idMaterial]);
        return redirect()->route('materials.index')->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified material.
     *
     * @param  Material  $material
     * @return \Illuminate\View\View
     */
    public function show(Material $material)
    {
        Log::info('Displaying material', ['id' => $material->idMaterial]);
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified material.
     *
     * @param  Material  $material
     * @return \Illuminate\View\View
     */
    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    /**
     * Update the specified material in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Material  $material
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Material $material)
    {
        $validatedData = $request->validate([
            'nombreMaterial' => 'required|string|max:255',
            'precioKg' => 'required|numeric|min:0',
        ]);

        Log::info('Updating material', ['id' => $material->idMaterial, 'data' => $validatedData]);
        $material->update($validatedData);

        Log::info('Material updated successfully', ['id' => $material->idMaterial]);
        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified material from storage.
     *
     * @param  Material  $material
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Material $material)
    {
        Log::warning('Deleting material', ['id' => $material->idMaterial]);
        $material->delete();

        Log::info('Material deleted successfully', ['id' => $material->idMaterial]);
        return redirect()->route('materials.index')
        ->with('mensaje', 'Material eliminado exitosamente.')
        ->with('icono','success');
    }
}
