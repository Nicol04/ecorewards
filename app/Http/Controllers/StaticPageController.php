<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Escuela;
use Illuminate\Support\Facades\Auth;
use App\Models\Punto;
use App\Models\Reciclaje;
use App\Models\Canje;
use App\Models\Usuario;
use App\Models\CanjeComentario;
use App\Models\Categorium;
use App\Models\Recompensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StaticPageController extends Controller
{
    public function show($page)
    {
        $path = public_path('static/' . $page . '.html');

        if (File::exists($path)) {
            return Response::file($path);
        }

        abort(404);
    }

    public function sobrenosotros()
    {
        return view('static.sobrenosotros');
    }
    public function comofunciona()
    {
        return view('static.comofunciona');
    }
    public function contacto()
    {
        return view('static.contacto');
    }
    public function escuela()
    {
        $escuelas = Escuela::all();
        return view('static.escuela', compact('escuelas'));
    }
    public function recompensas()
    {
        return view('static.recompensas');
    }
    public function perfil()
{
    // Obtén el usuario autenticado
    $usuario = Auth::user();

    // Obtén los datos de la tabla `persona` relacionados con el usuario
    $persona = $usuario->persona; // Asumiendo que hay una relación definida entre Usuario y Persona

    // Cargar las escuelas relacionadas (grado, sección y nombre de la escuela)
    $persona->load('escuelas');

    // Pasa los datos a la vista
    return view('static.perfil', compact('usuario', 'persona'));
}
public function historial_canjes()
{
    // Obtener el usuario autenticado
    $usuario = Auth::user();

    // Obtener los canjes del usuario autenticado, con las relaciones necesarias
    $canjes = Canje::where('idusuario', $usuario->idUsuario)
                    ->with(['recompensa', 'usuario', 'canje_comentario'])  // Incluir comentarios de los canjes
                    ->get();

    // Calcular el promedio de puntuación y el total de comentarios para cada canje
    foreach ($canjes as $canje) {
        // Calcular el total de comentarios
        $totalComentarios = $canje->canje_comentario->count();

        // Calcular el promedio de puntuación (si existen comentarios)
        $promedioPuntuacion = $canje->canje_comentario->avg('puntuacion');

        // Asignar los valores calculados a los canjes
        $canje->total_comentarios = $totalComentarios;
        $canje->promedio_puntuacion = $promedioPuntuacion ?? 0;  // Si no hay puntuaciones, asignar 0
    }

    // Pasar los canjes a la vista
    return view('static.historial_canjes', compact('canjes'));
}



    public function canjes(Request $request)
    {
        // Obtener el ID de la categoría desde los parámetros de la URL
    $categoriaId = $request->query('categoria');

    // Si hay un ID de categoría, filtrar las recompensas por esa categoría
    if ($categoriaId) {
        $recompensas = Recompensa::where('idcategoria', $categoriaId)
            ->with('categorium')
            ->paginate(6);
    } else {
        // Caso contrario, mostrar todas las recompensas
        $recompensas = Recompensa::with('categorium')->paginate(6);
    }

    // Obtener todas las categorías con el conteo de recompensas asociadas
    $categorias = Categorium::withCount('recompensa')->get();

        return view('static.canjes', compact('recompensas', 'categorias', 'categoriaId'));
    }

    public function puntos()
{
    $usuario = Auth::user();

    // Obtener los puntos relacionados al usuario
    $puntos = $usuario->punto;

    // Calcular el nivel basado en el total de puntos
    $nivel = $this->calcularNivel($puntos->totalPuntos);

    // Pasar los datos a la vista
    return view('static.puntos', compact('usuario', 'puntos', 'nivel'));
}

/**
 * Función para calcular el nivel según los puntos totales
 */
private function calcularNivel($totalPuntos)
{
    if ($totalPuntos < 2000) {
        return 'Iniciador Ecológico';
    } elseif ($totalPuntos < 5000) {
        return 'Defensor Verde';
    } elseif ($totalPuntos < 10000) {
        return 'Guardián del Planeta';
    } elseif ($totalPuntos < 20000) {
        return 'Héroe Ecológico';
    } else {
        return 'Leyenda Verde';
    }
}

    public function reciclaje()
    {
        // Obtén el usuario autenticado
        $usuario = Auth::user();

        // Verifica si hay registros de reciclaje asociados al usuario
        $reciclajes = Reciclaje::with('material')
            ->where('idusuario', $usuario->idUsuario)
            ->get();

        // Retorna la vista con los datos
        return view('static.reciclaje', compact('reciclajes'));
    }
    public function informacion_recompensas($id)
    {
        // Obtener la recompensa con la categoría
        $recompensa = Recompensa::with([
            'categorium'
        ])->findOrFail($id);

        // Obtener los comentarios de los canjes de la recompensa
        $comentarios = CanjeComentario::whereHas('canje', function ($query) use ($id) {
            $query->where('idrecompensa', $id); // Relación con la recompensa
        })
        ->with(['canje.usuario']) // Mostrar detalles de usuario
        ->paginate(10);

        // Obtener el usuario actual y verificar si ya canjeó la recompensa
        $usuario = Auth::user();
        // Obtener los puntos del usuario
        $usuarioPuntos = Punto::where('idusuario', $usuario->idUsuario)->first();
        $canjeUsuario = $recompensa->canjes->firstWhere('idusuario', $usuario->idUsuario);
        $haCanjeado = !is_null($canjeUsuario);
        $idcanje = $haCanjeado ? $canjeUsuario->idCanje : null;

        // Contar los comentarios por recompensa
        $cantidadComentarios = CanjeComentario::whereHas('canje', function ($query) use ($id) {
            $query->where('idrecompensa', $id);
        })->count();

        return view('static.informacion_recompensas', compact('recompensa', 'comentarios', 'haCanjeado', 'usuario', 'idcanje', 'usuarioPuntos', 'cantidadComentarios'));
    }

}
