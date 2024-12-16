<?php

namespace App\Http\Controllers;

use App\Models\Reciclaje;
use App\Models\Material;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importar Log

class reciclajeController extends Controller
{
    /**
     * Mostrar todos los registros de reciclaje.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener los registros de reciclaje con las relaciones y aplicar paginación
        $reciclajes = Reciclaje::with(['material', 'usuario'])->paginate(10); // 10 es el número de registros por página
        
        // Log de información
        Log::info('Visualización de los registros de reciclaje', ['reciclajes' => $reciclajes]);

        // Retornar la vista con los reciclajes
        return view('reciclaje.index', compact('reciclajes'));
    }
    
    /**
     * Mostrar el formulario para crear un nuevo reciclaje.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Obtener las opciones de materiales y usuario para los select
        $materiales = Material::all();
        
        // Log de información

        return view('reciclaje.create', compact('materiales'));
    }

    /**
     * Almacenar un nuevo registro de reciclaje.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'idusuario' => 'required|exists:usuario,idUsuario',
            'fechaReciclaje' => 'required|date',
            'idmaterial' => 'required|exists:material,idMaterial',
            'cantidad' => 'required|numeric|min:0',
            'puntosObtenidos' => 'required|integer|min:0',
        ]);

        // Log de validación exitosa
        Log::info('Datos validados para registrar reciclaje', ['data' => $validated]);

        // Crear un nuevo registro de reciclaje
        Reciclaje::create([
            'idusuario' => $request->idusuario,
            'fechaReciclaje' => $request->fechaReciclaje,
            'idmaterial' => $request->idmaterial,
            'cantidad' => $request->cantidad,
            'puntosObtenidos' => $request->puntosObtenidos,
        ]);

        // Log de creación exitosa
        Log::info('Nuevo reciclaje registrado exitosamente', ['idusuario' => $request->idusuario, 'fechaReciclaje' => $request->fechaReciclaje]);

        // Redirigir a la vista de índice con un mensaje de éxito
        return redirect()->route('reciclaje.index')->with('success', 'Reciclaje registrado exitosamente');
    }

    /**
     * Mostrar el formulario para editar un reciclaje existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Obtener el registro de reciclaje por ID
        $reciclaje = Reciclaje::findOrFail($id);

        // Obtener las opciones de materiales y usuario para los select
        $materiales = Material::all();
        $usuario = Usuario::all();

        // Log de edición
        Log::info('Formulario de edición de reciclaje abierto', ['reciclaje' => $reciclaje, 'materiales' => $materiales, 'usuario' => $usuario]);

        // Retornar la vista de edición
        return view('reciclaje.edit', compact('reciclaje', 'materiales', 'usuario'));
    }

    /**
     * Actualizar un registro de reciclaje.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'idusuario' => 'required|exists:usuario,idUsuario',
            'fechaReciclaje' => 'required|date',
            'idmaterial' => 'required|exists:material,idMaterial',
            'cantidad' => 'required|numeric|min:0',
            'puntosObtenidos' => 'required|integer|min:0',
        ]);

        // Log de validación exitosa
        Log::info('Datos validados para actualizar reciclaje', ['data' => $validated]);

        // Buscar el reciclaje por ID
        $reciclaje = Reciclaje::findOrFail($id);

        // Actualizar los datos del reciclaje
        $reciclaje->update([
            'idusuario' => $request->idusuario,
            'fechaReciclaje' => $request->fechaReciclaje,
            'idmaterial' => $request->idmaterial,
            'cantidad' => $request->cantidad,
            'puntosObtenidos' => $request->puntosObtenidos,
        ]);

        // Log de actualización exitosa
        Log::info('Reciclaje actualizado exitosamente', ['id' => $id, 'data' => $reciclaje]);

        // Redirigir al índice con mensaje de éxito
        return redirect()->route('reciclaje.index')->with('success', 'Reciclaje actualizado exitosamente');
    }

    /**
     * Eliminar un registro de reciclaje.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Buscar el reciclaje por ID
        $reciclaje = Reciclaje::findOrFail($id);

        // Eliminar el registro
        $reciclaje->delete();

        // Log de eliminación exitosa
        Log::info('Reciclaje eliminado exitosamente', ['id' => $id]);

        // Redirigir con mensaje de éxito
        return redirect()->route('reciclaje.index')->with('success', 'Reciclaje eliminado exitosamente');
    }
}
