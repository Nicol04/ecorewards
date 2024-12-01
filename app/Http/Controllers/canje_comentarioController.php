<?php

namespace App\Http\Controllers;

use App\Models\CanjeComentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class canje_comentarioController extends Controller
{
    public function index(Request $request)
    {

    }

    public function create()
    {
        $canjecomentario = CanjeComentario::all();
        return view('canjecomentario.create', compact('canjecomentario'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idcanje' => 'required|integer|exists:canjes,idCanje',
            'fotoObjeto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'comentario' => 'required|string|max:255',
            'fechaComentario' => 'required|date',
            'puntuacion' => 'required|integer|min:0|max:5',
        ], [
            'idcanje.required' => 'El canje es obligatorio.',
            'comentario.required' => 'El comentario es obligatorio.',
            'fechaComentario.required' => 'La fecha del comentario es obligatoria.',
            'puntuacion.required' => 'La puntuación es obligatoria.',
            'fotoObjeto.image' => 'El archivo debe ser una imagen.',
            'fotoObjeto.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'fotoObjeto.max' => 'La imagen no debe superar los 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rutaImagen = null;
        if ($request->hasFile('fotoObjeto')) {
            $rutaImagen = $request->file('fotoObjeto')->store('fotos', 'public');
        }

        CanjeComentario::create([
            'idcanje' => $request->idcanje,
            'fotoObjeto' => $rutaImagen,
            'comentario' => $request->comentario,
            'fechaComentario' => $request->fechaComentario,
            'puntuacion' => $request->puntuacion,
        ]);

        return redirect()->route('canje_comentario.index')
            ->with('mensaje', 'Comentario creado correctamente.')
            ->with('icono', 'success');
    }
}
