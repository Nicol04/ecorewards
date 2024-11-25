<?php

namespace App\Http\Controllers;

use App\Models\Punto;
use App\Models\usuarioModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class puntosController extends Controller
{
    public function index(): JsonResponse
    {
        $puntos = Punto::all(); 
        return response()->json(['data' => $puntos], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idusuario' => 'required|exists:usuarios,idusuario',
            'totalPuntos' => 'required|integer|max:99999999999',
            'puntosUtilizados' => 'required|integer|max:99999999999',
            'puntosDisponibles' => 'required|integer|max:99999999999',
        ], [
            'idusuario.required' => 'El ID del usuario es obligatorio.',
            'idusuario.exists' => 'El usuario no existe.',
            'totalPuntos.required' => 'El total de puntos es obligatorio.',
            'puntosUtilizados.required' => 'Los puntos utilizados son obligatorios.',
            'puntosDisponibles.required' => 'Los puntos disponibles son obligatorios.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $puntos = Punto::create($request->only([
                'idusuario', 
                'totalPuntos', 
                'puntosUtilizados', 
                'puntosDisponibles'
            ]));

            return response()->json(['message' => 'Puntos creados con éxito', 'data' => $puntos], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear los puntos: ' . $e->getMessage()], 400);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'idusuario' => 'exists:usuarios,idUsuario',
            'totalPuntos' => 'integer|max:99999999999',
            'puntosUtilizados' => 'integer|max:99999999999',
            'puntosDisponibles' => 'integer|max:99999999999',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $puntos = Punto::findOrFail($id); // Buscar por ID
            $puntos->update($request->only(['idUsuario', 'totalPuntos', 'puntosUtilizados', 'puntosDisponibles']));

            return response()->json(['message' => 'Puntos actualizados satisfactoriamente', 'data' => $puntos], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Puntos no encontrados'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar los puntos: ' . $e->getMessage()], 500);
        }
    }
}