<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use App\Models\escuelasModel;
use Illuminate\Http\Request;
use App\Config\responseHttp;
use Illuminate\Support\Facades\Validator;
use Exception;

class escuelasController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $escuelas = escuelasModel::all();
            return response()->json(['data' => $escuelas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al listar las escuelas: ' . $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreEscuela' => 'required|string|max:150|unique:escuelas,nombreEscuela',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|size:9',
            'director' => 'required|string|max:100',
            'logoEscuela' => 'nullable|string|max:255',
        ], [
            'nombreEscuela.required' => 'El nombre de la escuela es obligatorio.',
            'nombreEscuela.string' => 'El nombre de la escuela debe ser una cadena de caracteres.',
            'nombreEscuela.max' => 'El nombre de la escuela no puede exceder los 150 caracteres.',
            'nombreEscuela.unique' => 'Ya existe una escuela con este nombre.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser una cadena de caracteres.',
            'direccion.max' => 'La dirección no puede exceder los 255 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.size' => 'El teléfono debe contener exactamente 9 dígitos.',
            'director.required' => 'El director es obligatorio.',
            'director.string' => 'El director debe ser una cadena de caracteres.',
            'director.max' => 'El nombre del director no puede exceder los 100 caracteres.',
            'logoEscuela.nullable' => 'El logo de la escuela es opcional.',
            'logoEscuela.string' => 'El logo debe ser una cadena de caracteres (ruta o URL).',
            'logoEscuela.max' => 'La ruta o URL del logo no puede exceder los 255 caracteres.',
        ]);
        if ($validator->fails()) {
            return responseHttp::status400($validator->errors()->first());
        }
        try {
            $escuela = escuelasModel::create($request->only([
                'nombreEscuela', 
                'direccion', 
                'telefono', 
                'director', 
                'logoEscuela'
            ]));
            return responseHttp::status201('Escuela creada con éxito');
        } catch (Exception $e) {
            return responseHttp::status400('Error al crear la escuela: ' . $e->getMessage());
        }
    }
}
