<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Escuela;
use Illuminate\Support\Facades\Auth;
use App\Models\Punto;
use App\Models\Reciclaje;
use App\Models\Canje;

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
    public function canjes()
    {
        // Obtener los canjes con las relaciones necesarias
        $canjes = Canje::with(['recompensa', 'usuario'])->get();

        // Pasar los canjes a la vista
        return view('static.canjes', compact('canjes'));
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

}
