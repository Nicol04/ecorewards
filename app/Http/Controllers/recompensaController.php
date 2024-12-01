<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Recompensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class recompensaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categorias = Categorium::all();
        Log::info('Listando recompensas con filtros.', $request->all());

        // Variable para guardar la consulta SQL
        $query = Recompensa::query();

        // Filtrar por categoría
        if ($request->filled('idcategoria')) {
            $query->where('idcategoria', $request->input('idcategoria'));
        }

        // Filtrar por nombre de la recompensa
        if ($request->filled('nombre')) {
            $query->where('nombreRecompensa', 'like', '%' . $request->input('nombre') . '%');
        }

        // Filtrar por puntos requeridos (exacto o rango)
        if ($request->filled('puntosRequeridos')) {
            $query->where('puntosRequeridos', $request->input('puntosRequeridos'));
        }
        if ($request->filled('puntosMin')) {
            $query->where('puntosRequeridos', '>=', $request->input('puntosMin'));
        }
        if ($request->filled('puntosMax')) {
            $query->where('puntosRequeridos', '<=', $request->input('puntosMax'));
        }

        // Filtrar por descripción
        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }

        // Filtrar por nombre de la categoría
        if ($request->filled('nombreCategoria')) {
            $query->whereHas('categorium', function ($q) use ($request) {
                $q->where('nombreCategoria', 'like', '%' . $request->input('nombreCategoria') . '%');
            });
        }

        $recompensas = $query->get();
        return view('recompensas.index', compact('recompensas', 'categorias'));
    }

    public function showRecompensas()
    {
        // Paginar recompensas con 6 elementos por página
        $recompensas = Recompensa::with('categorium')->paginate(6);

        // Obtener categorías con el conteo de recompensas asociadas (opcional)
        $categorias = Categorium::withCount('recompensa')->get();

        return view('static.recompensas', compact('recompensas', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categorium::all();
        return view('recompensas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /*public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombreRecompensa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'puntosRequeridos' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'idcategoria' => 'required|integer|exists:categoria,idcategoria',
        ]);

        if ($validator->fails()) {
            Log::error('Error al crear recompensa.', ['errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recompensa = Recompensa::create($request->all());
        Log::info('Recompensa creada exitosamente.', ['idRecompensa' => $recompensa->idRecompensa]);

        return redirect()->route('recompensas.index')
        ->with('mensaje', 'Recompensa creada correctamente.')
        ->with('icono','success');
    } */

    public function store(Request $request)
    {
        // Validación de los datos, incluyendo la imagen
        $validator = Validator::make($request->all(), [
            'nombreRecompensa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'puntosRequeridos' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            'idcategoria' => 'required|integer|exists:categoria,idCategoria',
        ], [
            'nombreRecompensa.required' => 'El nombre de la recompensa es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'puntosRequeridos.required' => 'El valor en puntos es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
            'idcategoria.required' => 'La categoría es obligatoria.',
        ]);

        // Si la validación falla, redirige con errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Manejo de la imagen
        $rutaImagen = '';
        if ($request->hasFile('imagen')) {
            // Comprobamos el tipo MIME
            $mimeType = $request->file('imagen')->getMimeType();
            Log::info('Tipo MIME del archivo: ' . $mimeType); // Log para depuración

            // Almacenar la imagen si el MIME es correcto
            if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
                // Usamos la función store() para guardar la imagen en el directorio público
                $rutaImagen = $request->file('imagen')->store('fotos', 'public');
            } else {
                Log::error('El archivo no es una imagen válida: ' . $mimeType);
                return redirect()->back()->withErrors(['imagen' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.'])->withInput();
            }
        }

        // Crear la recompensa
        Recompensa::create([
            'nombreRecompensa' => $request->nombreRecompensa,
            'descripcion' => $request->descripcion,
            'puntosRequeridos' => $request->puntosRequeridos,
            'stock' => $request->stock,
            'imagen' => $rutaImagen, // Guarda la ruta de la imagen
            'idcategoria' => $request->idcategoria,
        ]);

        return redirect()->route('recompensas.index')
            ->with('mensaje', 'Recompensa creada correctamente.')
            ->with('icono', 'success');
    }




    /**
     * Display the specified resource.
     */
    public function show(Recompensa $recompensa)
    {
        return view('recompensas.show', compact('recompensa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recompensa $recompensa)
    {
        $categorias = Categorium::all();
        return view('recompensas.edit', compact('recompensa', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recompensa $recompensa)
    {
        $validator = Validator::make($request->all(), [
            'nombreRecompensa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'puntosRequeridos' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|string|max:255',
            'idcategoria' => 'required|integer|exists:categoria,idcategoria',
        ]);

        if ($validator->fails()) {
            Log::error('Error al actualizar recompensa.', ['idRecompensa' => $recompensa->idRecompensa, 'errors' => $validator->errors()->all()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $recompensa->update($request->all());
        Log::info('Recompensa actualizada exitosamente.', ['idRecompensa' => $recompensa->idRecompensa]);

        return redirect()->route('recompensas.index')
            ->with('success', 'Recompensa actualizada correctamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recompensa $recompensa)
    {
        $recompensa->delete();
        Log::info('Recompensa eliminada exitosamente.', ['idRecompensa' => $recompensa->idRecompensa]);

        return redirect()->route('recompensas.index')
            ->with('mensaje', 'Recompensa eliminada correctamente.')
            ->with('icono', 'success');
    }
}
