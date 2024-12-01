<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class escuelasController extends Controller
{
    /**
     * Mostrar la lista de escuelas.
     */
    public function index()
    {
        $escuelas = Escuela::all();
        return view('escuelas.index', compact('escuelas'));
    }

    public function showEscuelas($id)
    {
        $escuela = Escuela::findOrFail($id);

        $frases = [
            "Reciclar es darle un respiro al planeta, ¡únete al cambio!",
            "Pequeñas acciones crean grandes cambios, reciclar es una de ellas.",
            "El futuro depende de lo que hagas hoy, ¡empieza reciclando!",
            "Transforma el desperdicio en esperanza, ¡recicla!",
            "Cuidemos nuestra tierra, una botella reciclada a la vez.",
            "Reciclar no cuesta, pero su impacto es invaluable.",
            "Los residuos de hoy pueden ser los recursos del mañana.",
            "El reciclaje es una forma de amor al planeta, ¡demuestra el tuyo!",
            "No es basura, es oportunidad: ¡recicla!",
            "La verdadera riqueza está en un mundo limpio, ¡recicla y construyamos el futuro!",
        ];

        $frase = $frases[array_rand($frases)];

        return view('static.informacion_escuelas', compact('escuela', 'frase'));
    }
    /**
     * Mostrar el formulario para crear una nueva escuela.
     */
    public function create()
    {
        return view('escuelas.create');
    }

    /**
     * Guardar una nueva escuela en la base de datos.
     */
    /* public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombreEscuela' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'logoEscuela' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logoEscuela')) {
            $validatedData['logoEscuela'] = $request->file('logoEscuela')->store('logos', 'public');
        }

        Escuela::create($validatedData);

        return redirect()->route('escuelas.index')
        ->with('mensaje', 'Escuela creada con éxito.')
        ->with('icono','success');
    } */

    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'nombreEscuela' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|regex:/^[0-9]{9}$/',
            'director' => 'nullable|string|max:90',
            'logoEscuela' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            'direccionLink' => 'nullable|url|max:255',
            'direccionUrl' => 'nullable|url|max:2048',
        ], [
            'nombreEscuela.required' => 'El nombre de la escuela es obligatorio.',
            'direccion.string' => 'La dirección debe ser un texto.',
            'direccion.required' => 'La direccion del colegio es obligatorio.',
            'telefono.string' => 'El teléfono debe ser un texto.',
            'telefono.regex' => 'El teléfono debe contener solo números y ser de 9 dígitos.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'director.string' => 'El nombre del director debe ser un texto.',
            'director.required' => 'El nombre del director es obligatorio.',
            'logoEscuela.image' => 'El archivo debe ser una imagen.',
            'logoEscuela.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'logoEscuela.max' => 'La imagen no debe superar los 2MB.',
            'direccionLink.url' => 'El enlace debe ser una URL válida.',
            'direccionLink.required' => 'El link de la direccion del colegio es obligatorio.',
            'direccionUrl.url' => 'El enlace de direccionUrl debe ser una URL válida.',
            'direccionUrl.required' => 'El link de la direccion del colegio en frame es obligatorio.',
        ]);

        // Si la validación falla, redirige con errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Manejo de la imagen
        $rutaLogo = '';
        if ($request->hasFile('logoEscuela')) {
            $mimeType = $request->file('logoEscuela')->getMimeType();
            Log::info('Tipo MIME del archivo: ' . $mimeType); // Log para depuración

            // Verificamos que el MIME sea válido antes de guardar
            if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
                $rutaLogo = $request->file('logoEscuela')->store('logos', 'public');
            } else {
                Log::error('El archivo no es una imagen válida: ' . $mimeType);
                return redirect()->back()->withErrors(['logoEscuela' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.'])->withInput();
            }
        }

        // Crear la escuela
        Escuela::create([
            'nombreEscuela' => $request->nombreEscuela,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'director' => $request->director,
            'logoEscuela' => $rutaLogo, // Guarda la ruta del logo
            'direccionLink' => $request->direccionLink, // Guardar el enlace
            'direccionUrl' => $request->direccionUrl, // Guardar el enlace para el iframe
        ]);

        return redirect()->route('escuelas.index')
            ->with('mensaje', 'Escuela creada con éxito.')
            ->with('icono', 'success');
    }

    /**
     * Mostrar los detalles de una escuela específica.
     */
    public function show(Escuela $escuela)
    {
        return view('escuelas.show', compact('escuela'));
    }

    /**
     * Mostrar el formulario para editar una escuela existente.
     */
    public function edit(Escuela $escuela)
    {
        return view('escuelas.edit', compact('escuela'));
    }

    /**
     * Actualizar una escuela en la base de datos.
     */
    public function update(Request $request, Escuela $escuela)
    {
        $validatedData = $request->validate([
            'nombreEscuela' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'logoEscuela' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logoEscuela')) {
            // Eliminar el logo antiguo si existe
            if ($escuela->logoEscuela) {
                Storage::disk('public')->delete($escuela->logoEscuela);
            }
            $validatedData['logoEscuela'] = $request->file('logoEscuela')->store('logos', 'public');
        }

        $escuela->update($validatedData);

        return redirect()->route('escuelas.index')
            ->with('mensaje', 'Escuela actualizada con éxito.')
            ->with('icono', 'success');
    }

    /**
     * Eliminar una escuela de la base de datos.
     */
    public function destroy(Escuela $escuela)
    {
        if ($escuela->logoEscuela) {
            Storage::disk('public')->delete($escuela->logoEscuela);
        }

        $escuela->delete();

        return redirect()->route('escuelas.index')
            ->with('mensaje', 'Escuela eliminada con éxito.')
            ->with('icono', 'success');
    }
}
