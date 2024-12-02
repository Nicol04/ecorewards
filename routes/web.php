<?php

use App\Http\Controllers\canje_comentarioController;
use App\Http\Controllers\categoriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\escuelasController;
use App\Http\Controllers\materialController;
use App\Http\Controllers\recompensaController;
use App\Http\Controllers\usuarioController;
// routes/web.php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/static', function () {
    return file_get_contents(public_path('static/index.html'));
});

Route::get('/sobrenosotros', action: [StaticPageController::class, 'sobrenosotros'])
->name('public.sobrenosotros');

Route::get('/comofunciona', action: [StaticPageController::class, 'comofunciona'])
->name('public.comofunciona');

Route::get('/contacto', action: [StaticPageController::class, 'contacto'])
->name('public.contacto');

Route::get('/escuela', action: [StaticPageController::class, 'escuela'])
->name('public.escuela');

Route::get('/escuela/{id}', [EscuelasController::class, 'showEscuelas'])
->name('public.informacion_escuelas');

Route::get('/recompensas', action: [StaticPageController::class, 'recompensas'])
->name('public.recompensas');

Route::get('/recompensas', [RecompensaController::class, 'showRecompensas'])
->name('public.recompensas');

Route::get('/perfil', [StaticPageController::class, 'perfil'])
->name('public.perfil')->middleware('auth');

Route::get('/historial_canjes', [StaticPageController::class, 'historial_canjes'])
->name('public.historial_canjes')->middleware('auth');

Route::get('/canjes', [StaticPageController::class, 'canjes'])
->name('public.canjes')->middleware('auth');

Route::get('/puntos', [StaticPageController::class, 'puntos'])
->name('public.puntos')->middleware('auth');

Route::get('/reciclaje', [StaticPageController::class, 'reciclaje'])
->name('public.reciclaje')->middleware('auth');

Route::get('/informacion_recompensas/{id}', [StaticPageController::class, 'informacion_recompensas'])
->name('public.informacion_recompensas')->middleware('auth');

Route::post('/comentarios/store', [canje_comentarioController::class, 'store'])->name('canje_comentario.store');

Auth::routes();
//Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('hogar');;


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('escuelas', escuelasController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('materials', materialController::class);
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('categorias', categoriaController::class);
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('recompensas', recompensaController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('canjecomentario', canje_comentarioController::class);
});