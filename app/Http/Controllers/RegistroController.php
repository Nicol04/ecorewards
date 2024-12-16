<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Escuela;
use App\Models\PersonaEscuela;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // Importamos Auth

class RegistroController extends Controller
{
    public function index()
    {
        $escuelas = Escuela::all();
        return view('registro', compact('escuelas'));
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fechaNacimiento' => 'required|date|before:today',
            'direccion' => 'required|string|max:500',
            'telefono' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'genero' => 'required|in:masculino,femenino,otro',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

            // Datos de la escuela // Corregido el campo idEscuela
        ]);

        // Manejo de la foto
        $rutaFoto = '';
        if ($request->hasFile('foto')) {
            // Comprobamos el tipo MIME
            $mimeType = $request->file('foto')->getMimeType();
            Log::info('Tipo MIME del archivo: ' . $mimeType); // Log para depuración

            // Almacenar la foto si el MIME es correcto
            if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
                // Usamos la función store() para guardar la imagen en el directorio público
                $rutaFoto = $request->file('foto')->store('fotos', 'public');
            } else {
                Log::error('El archivo no es una imagen válida: ' . $mimeType);
                return redirect()->back()->withErrors(['foto' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.'])->withInput();
            }
        }

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener el ID del usuario autenticado
            $userId = Auth::id();

            // Crear la persona, incluyendo el user_id del usuario autenticado
            $persona = Persona::create([
                'nombre' => $validatedData['nombre'],
                'apellido' => $validatedData['apellido'],
                'fechaNacimiento' => $validatedData['fechaNacimiento'],
                'direccion' => $validatedData['direccion'],
                'telefono' => $validatedData['telefono'],
                'genero' => $validatedData['genero'],
                'idusuario' => $userId,
                'foto' => $rutaFoto,
                  // Asociamos el ID del usuario autenticado
            ]);

            Log::error("El id de la persona es" . $persona->idPersona);

            //  Asociar la persona con la escuela
            $personaEscuela = PersonaEscuela::create([
                'grado' => $request->grado,
                'seccion' => $request->seccion,
                'idescuela' => $request->idescuela,
                'idpersona' => $persona->idPersona,  // Usamos el id generado de la persona
            ]);

            // Confirmar la transacción
            DB::commit();

            // Redirigir con mensaje de éxito
            return view('home')
                ->with('mensaje', 'Información completada exitosamente')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            // Hacer rollback en caso de error
            DB::rollBack();

            // Registrar el error en el log
            Log::error('Error al registrar persona:', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->all() // Datos de la solicitud para depuración
            ]);

            // Redirigir con mensaje de error
            return redirect()->back()
                ->with('mensaje', 'Hubo un error, por favor intente nuevamente.')
                ->with('icono', 'error')
                ->with('error', $e->getMessage());
        }
    }
}
