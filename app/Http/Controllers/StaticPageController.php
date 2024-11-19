<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
}
