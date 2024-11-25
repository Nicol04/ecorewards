<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Asegúrate de importar la clase Log


class usuarioController extends Controller
{
    // Mostrar listado de usuarios
    public function index()
    {
        $usuarios = Usuario::with('persona')->paginate(10); // Obtener usuarios con sus personas asociadas
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación de usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required|string|max:255',
            'tipoUsuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            Log::error('Validación fallida', [
                'errors' => $validator->errors(),
                'input' => $request->all()
            ]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Crear el usuario
            $usuario = Usuario::create([
                'nombreUsuario' => $request->nombreUsuario,
                'tipoUsuario' => $request->tipoUsuario,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encriptar la contraseña
            ]);

            Log::info('Usuario creado', ['usuario_id' => $usuario->idUsuario]);

            // Crear la persona asociada
            Persona::create([
                'idusuario' => $usuario->idUsuario,
                'nombre' => $request->nombrePersona,
                'apellido' => $request->apellidoPersona,
                'fechaNacimiento' => $request->fechaNacimiento,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'genero' => $request->genero,
                'foto' => $request->foto,
            ]);

            Log::info('Persona asociada al usuario', ['usuario_id' => $usuario->idUsuario]);

            return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            Log::error('Error al crear el usuario', [
                'exception' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return redirect()->back()
            ->with('mensaje', 'Hubo un problema al crear el usuario')
            ->with('icono','error');
        }
    }

    // Mostrar el formulario de edición de un usuario
    public function edit($id)
    {
        $usuario = Usuario::with('persona')->findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Mostrar detalles de un usuario
    public function show($id)
    {
        // Obtener el usuario con su persona asociada
        $usuario = Usuario::with('persona')->findOrFail($id);

        // Retornar la vista de detalle, pasando el usuario
        return view('usuarios.show', compact('usuario'));
    }


    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'nombreUsuario' => 'required|string|max:255',
            'tipoUsuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email,' . $id . ',idUsuario',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar el usuario
        $usuario->update([
            'nombreUsuario' => $request->nombreUsuario,
            'tipoUsuario' => $request->tipoUsuario,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
        ]);

        // Actualizar la persona asociada
        $persona = $usuario->persona;
        $persona->update([
            'nombre' => $request->nombrePersona,
            'apellido' => $request->apellidoPersona,
            'fechaNacimiento' => $request->fechaNacimiento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'genero' => $request->genero,
            'foto' => $request->foto,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        // Eliminar el usuario
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
