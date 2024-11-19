<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Config\responseHttp;
use App\Models\canjesModel;
use App\Models\recompensaModel;
use Illuminate\Support\Facades\Validator;
use Exception;
class canjesController extends Controller
{
    public function index(): JsonResponse
    {
        $canjes = CanjesModel::all(); 
        return response()->json(['data' => $canjes], 200);
    }

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
            $recompensa = RecompensaModel::find($request->idrecompensa);

            if ($recompensa->stock <= 0) {
                return responseHttp::status400('La recompensa seleccionada no tiene stock disponible.');
            }
            $canje = canjesModel::create($request->only([
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
    }
}
