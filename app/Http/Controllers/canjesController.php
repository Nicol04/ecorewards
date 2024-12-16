<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Config\responseHttp;
use App\Models\Canje;
use App\Models\Punto;
use App\Models\Recompensa;
use Illuminate\Support\Facades\Validator;
use Exception;
class canjesController extends Controller
{
    public function index(): JsonResponse
    {
        $canjes = Canje::all(); 
        return response()->json(['data' => $canjes], 200);
    }
    /*
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idusuario' => 'required|integer|exists:usuarios,idUsuario', 
            'idrecompensa' => 'required|integer|exists:recompensas,idRecompensa', 
            'fechaCanje' => 'required|date',
            'puntosUtilizados' => 'required|integer|min:1',
        ], [
            'idusuario.required' => 'El id de usuario es obligatorio.',
            'idusuario.exists' => 'El usuario no existe.',
            'idrecompensa.required' => 'El id de la recompensa es obligatorio.',
            'idrecompensa.exists' => 'La recompensa no existe.',
            'fechaCanje.required' => 'Debe ingresar una fecha válida.',
            'fechaCanje.date' => 'La fecha ingresada no es correcta.',
            'puntosUtilizados.required' => 'Los puntos utilizados son obligatorios.',
            'puntosUtilizados.integer' => 'Los puntos utilizados deben ser un número entero.',
            'puntosUtilizados.min' => 'Debe utilizar al menos 1 punto.',
        ]);

        if ($validator->fails()) {
            return responseHttp::status400($validator->errors()->first());
        }
        try {
            $recompensa = Recompensa::find($request->idrecompensa);

            if ($recompensa->stock <= 0) {
                return responseHttp::status400('La recompensa seleccionada no tiene stock disponible.');
            }
            $canje = Canje::create($request->only([
                'idusuario',
                'idrecompensa',
                'fechaCanje',
                'puntosUtilizados'
            ]));
            $recompensa->stock -= 1;
            $recompensa->save();

            return responseHttp::status201('Canje creado con éxito y stock de recompensa actualizado.');
        } catch (Exception $e) {
            return responseHttp::status400('Error al crear el canje: ' . $e->getMessage());
        }
    } */
    public function store(Request $request)
{
    // Validación
    $request->validate([
        'recompensa_id' => 'required|exists:recompensa,idRecompensa',
        'usuario_id' => 'required|exists:usuario,idUsuario',
    ]);

    // Obtener los modelos de usuario y recompensa
    $usuario = Usuario::find($request->usuario_id);
    $recompensa = Recompensa::find($request->recompensa_id);

    // Verificar si el usuario tiene suficientes puntos
    if ($usuario->punto->puntosDisponibles < $recompensa->puntosRequeridos) {
        return redirect()->back()
            ->with('mensaje', 'No tienes suficientes puntos para canjear esta recompensa.')
            ->with('icono','error');
    }

    // Verificar si hay stock disponible
    if ($recompensa->stock <= 0) {
        return redirect()->back()
            ->with('mensaje', 'No hay stock disponible de esta recompensa.')
            ->with('icono','error');
    }

    // Crear el canje
    $canje = new Canje();
    $canje->idusuario = $usuario->idUsuario; // Cambia 'usuario_id' por 'idusuario'
    $canje->idrecompensa = $recompensa->idRecompensa; // Cambia 'recompensa_id' por 'idrecompensa'
    $canje->fechaCanje = now(); // Fecha del canje
    $canje->puntosUtilizados = $recompensa->puntosRequeridos; // Puntos utilizados en el canje
    $canje->save();

    // Actualizar puntos del usuario y el stock de la recompensa
    $usuario->punto->puntosDisponibles -= $recompensa->puntosRequeridos;
    $usuario->punto->puntosUtilizados += $recompensa->puntosRequeridos;
    $usuario->punto->save();

    // Actualizar el stock de la recompensa
    $recompensa->stock -= 1;
    $recompensa->save();

    return redirect()->route('public.canjes')
        ->with('mensaje', 'Recompensa canjeada con éxito. Tu producto será enviado a tu institución en aproximadamente 2 días. Acércate a dirección a recogerlo.')
        ->with('icono', 'success');
}

}
