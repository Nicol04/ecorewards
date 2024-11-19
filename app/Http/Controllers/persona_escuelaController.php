<?php

namespace App\Http\Controllers;
use App\Config\responseHttp;
use App\Models\Persona_escuelaModel;
use App\Models\PersonaModel;
use App\Models\UsuarioModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class persona_escuelaController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $persona_escuela = Persona_escuelaModel::all(); 
            return ResponseHttp::status200($persona_escuela);
        } catch (\Exception $e) {
            return ResponseHttp::status500('Error al listar las entradas en persona_escuela: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idpersona' => 'required|integer|exists:persona,idPersona',
            'idescuela' => 'required|integer|exists:escuelas,idEscuela',
            'grado' => 'required|integer|in:1,2,3,4,5',
            'seccion' => 'required|string|in:A,B,C,D',
        ], [
            'idpersona.required' => 'El idpersona es obligatorio.',
            'idpersona.exists' => 'El idpersona no existe en la tabla persona.',
            'idescuela.required' => 'El idescuela es obligatorio.',
            'idescuela.exists' => 'El idescuela no existe en la tabla escuelas.',
            'grado.required' => 'Ingresa tu grado.',
            'grado.in' => 'El grado debe ser 1, 2, 3, 4 o 5.',
            'seccion.required' => 'No tienes sección?',
            'seccion.in' => 'La sección debe ser A, B, C o D.',
        ]);

        if ($validator->fails()) {
            return responseHttp::status400($validator->errors());
        }
        $usuario = usuarioModel::where('idpersona', $request->idpersona)->first();
        if (!$usuario) {
            return responseHttp::status400('El idpersona no tiene un usuario asociado.');
        }
        if (!in_array($usuario->tipoUsuario, ['Estudiante', 'Docente', 'Director'])) {
            return responseHttp::status400('El idpersona no corresponde a un usuario válido (Estudiante, Docente o Director).');
        }
        try {
            $personaEscuela = Persona_escuelaModel::create([
                'idpersona' => $request->idpersona,
                'idescuela' => $request->idescuela,
                'grado' => $request->grado,
                'seccion' => $request->seccion,
            ]);

            return responseHttp::status201('Persona_escuela creada con éxito');
        } catch (Exception $e) {
            return responseHttp::status400('Error al crear la Persona_escuela: ' . $e->getMessage());
        }
    }
}