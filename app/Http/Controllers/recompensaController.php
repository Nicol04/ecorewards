<?php

namespace App\Http\Controllers;
use App\Models\recompensaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
class recompensaController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $recompensas = recompensaModel::all();

            // Recorre cada recompensa y convierte el campo 'imagen' a base64
            foreach ($recompensas as $recompensa) {
                if ($recompensa->imagen) {
                    $recompensa->imagen = base64_encode($recompensa->imagen);
                }
            }

            return response()->json(['data' => $recompensas], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al listar las recompensas: ' . $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required|string|max:15|unique:usuario,nombreUsuario', 
            'contrasena' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9.]{1,8}$/',
            'correoElectronico' => 'required|email|max:90|unique:usuario,correoElectronico', 
            'tipoUsuario' => 'required|string|in:Estudiante,Docente,Director,Administrador', 
            'idpersona' => 'required|integer|exists:persona,idPersona', 
        ], [
            'nombreUsuario.required' => 'Escribe un nombre de usuario que te identifique',
            'nombreUsuario.unique' => 'Este nombre de usuario ya está en uso',
            'nombreUsuario.max' => 'El nombre de usuario no debe tener más de 15 caracteres.',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.regex' => 'La contraseña debe contener letras, números y puntos, con un máximo de 8 caracteres.',
            'correoElectronico.required' => 'El correo electrónico es obligatorio.',
            'correoElectronico.unique' => 'Este correo electrónico ya está registrado.',
            'tipoUsuario.required' => 'Debe seleccionar un tipo de usuario válido.',
            'tipoUsuario.in' => 'El tipo de usuario seleccionado no es válido.',
            'idpersona.required' => 'El campo idpersona es obligatorio.',
            'idpersona.exists' => 'El idpersona no existe en la base de datos.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $recompensa = recompensaModel::create([
                'nombreUsuario' => $request->input('nombreUsuario'),
                'correoElectronico' => $request->input('correoElectronico'),
                'tipoUsuario' => $request->input('tipoUsuario'),
                'idpersona' => $request->input('idpersona'),
            ]);

            return response()->json(['message' => 'Usuario creado con éxito'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear al usuario: ' . $e->getMessage()], 400);
        }
    }
}
