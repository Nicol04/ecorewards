<?php

use App\Http\Controllers\categoriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\escuelasController;

// routes/web.php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/static', function () {
    return file_get_contents(public_path('static/index.html'));
});

Auth::routes();
//Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('escuelas', escuelasController::class);
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('categorias', categoriaController::class);
});