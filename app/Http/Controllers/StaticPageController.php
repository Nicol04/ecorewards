<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Escuela;

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
}
