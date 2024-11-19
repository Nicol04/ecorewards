<?php

namespace App\Http\Controllers;

use App\Models\materialModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Config\responseHttp;

class materialController extends Controller
{
    public function index(): JsonResponse
    {
        $materiales = materialModel::all(); 
        return response()->json(['data' => $materiales], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreMaterial' => 'required|string|max:50',
            'precioKg' => 'required|numeric|between:0,99999999999.99', // Regla de validación corregida
        ], [
            'nombreMaterial.required' => 'El nombre es obligatorio.',
            'precioKg.required' => 'El precio es obligatorio.',
            'precioKg.numeric' => 'El precio debe ser un número válido.',
        ]);

        if ($validator->fails()) {
            return responseHttp::status400($validator->errors()->first());
        }

        try {
            $material = materialModel::create($request->only([
                'nombreMaterial', 
                'precioKg',
            ]));

            return responseHttp::status201('El material fue creado con éxito');
        } catch (Exception $e) {
            return responseHttp::status400('Error al crear el material: ' . $e->getMessage());
        }
    }

    // Método para actualizar un material
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $material = materialModel::findOrFail($id); // Buscar el material por ID
            $material->update($request->only(['nombreMaterial', 'precioKg'])); // Actualizar los campos

            return response()->json(['message' => 'Material Actualizado satisfactoriamente', 'data' => $material], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Material no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el material: ' . $e->getMessage()], 500);
        }
    }
}