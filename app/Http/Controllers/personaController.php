<?php

namespace App\Http\Controllers;

use App\Models\PersonaModel;
use App\Models\Persona_escuelaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Config\responseHttp;

class personaController extends Controller
{
    public function index(): JsonResponse
    {
        $persona = PersonaModel::all(); 
        return response()->json(['data' => $persona], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fechaNacimiento' => 'required|date',
            'direccion' => 'required|string|max:90',
            'telefono' => 'required|string|size:9',
            'genero' => 'required|string|in:Femenino,Masculino,Otro|max:40',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'Escribe tu apellido, es importante',
            'fechaNacimiento.required' => 'Debe ingresar una fecha válida.',
            'fechaNacimiento.date' => 'Upps! No es una fecha correcta!.',
            'telefono.size' => 'El teléfono debe contener exactamente 9 dígitos.',
            'genero.in' => 'El género debe ser Femenino, Masculino o Otro.',
        ]);
        if ($validator->fails()) {
            return responseHttp::status400($validator->errors()->first());
        }

        try {
            $persona = PersonaModel::create($request->only([
                'nombre', 
                'apellido', 
                'fechaNacimiento', 
                'direccion', 
                'telefono', 
                'genero'
            ]));

            return responseHttp::status201('Persona creada con éxito');
        } catch (Exception $e) {
            return responseHttp::status400('Error al crear la persona: ' . $e->getMessage());
        }
    }

/*
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'apellido' => 'required', 
            'fechaNacimiento' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'genero' => 'required'
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
            $persona = personaModel::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido, 
                'fechaNacimiento' => $request->fechaNacimiento,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'genero' => $request->genero
            ]);
            if(!$persona){
                $data = [
                    'message' => 'Error al crear a la persona',
                    'status' =>500
                ];
                return response()->json($data, 500);
            }
            $data = [
                'persona' =>$persona,
                'status' => 201
            ];
            return response()->json($data, 201);
        }
    }*/

    // Método para actualizar una persona
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $persona = PersonaModel::findOrFail($id); // Buscar la persona por ID
            $persona->update($request->only(['nombre', 'apellido', 'fechaNacimiento', 'direccion', 'telefono', 'genero'])); // Actualizar los campos

            return response()->json(['message' => 'Persona actualizada satisfactoriamente', 'data' => $persona], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la persona: ' . $e->getMessage()], 500);
        }
    }

}
