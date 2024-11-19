<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\PersonaModel;
use App\Models\Persona_escuelaModel;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Config\ResponseHttp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Log;

class usuarioController extends Controller
{
    protected $personaController;

    public function __construct(PersonaController $personaController)
    {
        $this->personaController = $personaController;
    }
    public function index(): JsonResponse
    {
        try {
            $usuarios = Usuario::all();
            return response()->json(['data' => $usuarios], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al listar los usuarios: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required|string|max:15|unique:usuario,nombreUsuario', 
            'password' => 'required|string|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9.]{1,8}$/',
            'email' => 'required|email|max:90|unique:usuario,correoElectronico', 
            'tipoUsuario' => 'required|string|in:Estudiante,Docente,Director,Administrador', 
        ], [
            'nombreUsuario.required' => 'Escribe un nombre de usuario que te identifique',
            'nombreUsuario.unique' => 'Este nombre de usuario ya está en uso',
            'nombreUsuario.max' => 'El nombre de usuario no debe tener más de 15 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.regex' => 'La contraseña debe contener letras, números y puntos, con un máximo de 8 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'tipoUsuario.required' => 'Debe seleccionar un tipo de usuario válido.',
            'tipoUsuario.in' => 'El tipo de usuario seleccionado no es válido.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $hashedPassword = Hash::make($request->input('contrasena'));
            $usuario = Usuario::create([
                'nombreUsuario' => $request->input('nombreUsuario'),
                'password' => $hashedPassword, 
                'email' => $request->input('correoElectronico'),
                'tipoUsuario' => $request->input('tipoUsuario'),
            ]);

            return response()->json(['message' => 'Usuario creado con éxito'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear al usuario: ' . $e->getMessage()], 400);
        }
    }

    
    // Método para actualizar un usuario
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $usuario = Usuario::findOrFail($id); // Buscar usuario por ID
            $usuario->update($request->only(['nombreUsuario', 'correoElectronico', 'tipoUsuario'])); // Actualizar campos

            // Puedes incluir más lógica aquí si es necesario

            return response()->json(['message' => 'Usuario actualizado satisfactoriamente'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()], 500);
        }
    }
    
}
