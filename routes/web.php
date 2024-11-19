<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
