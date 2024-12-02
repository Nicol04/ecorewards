@extends('layouts.app')
@section('content')
<div class="d-flex">
    <!-- Panel lateral -->
    <div class="sidebar d-flex flex-column justify-content-center align-items-center">
        <!-- Opción: Configuración -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Configuración">
            <a href="{{ route('public.perfil') }}"><i class="fa fa-cog" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Configuración</span>
        </div>
        <!-- Opción: Canjes -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Canjes">
            <a href="{{ route('public.canjes') }}"><i class="fa fa-exchange-alt" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Canjes</span>
        </div>
        <!-- Opción: Puntos -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Puntos">
            <i class="fa fa-star" style="color: #ffffff; font-size: 1.5rem; transition: transform 0.3s;"></i>
            <span class="sidebar-text mt-2">Puntos</span>
        </div>
        <!-- Opción: Recompensas -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Recompensas">
            <i class="fa fa-gift" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i>
            <span class="sidebar-text mt-2">Recompensas</span>
        </div>
        <!-- Opción: Reciclaje -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Reciclaje">
            <a href="{{ route('public.reciclaje') }}"><i class="fa fa-recycle" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Reciclaje</span>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <!-- Tarjeta -->
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <!-- Saludo e información -->
                    <p style="font-size: 1.2rem;">
                        <i class="fa fa-level-up-alt" style="color: #578322; font-size: 1.5rem;"></i> 
                        Nivel: <strong>{{ $nivel }}</strong>
                    </p>
                    <h2 class="text-primary" style="font-size: 2rem;">
                        Hola, {{ $usuario->nombreUsuario }}! 
                        <i class="fa fa-hand-paper" style="color: #ffc107; font-size: 2rem;"></i>
                    </h2>
                    <p style="font-size: 1.2rem; color:#578322">
                    {{ $usuario->tipoUsuario }}
                    </p>
                    <p style="font-size: 1.2rem;">
                        <i class="fa fa-coins" style="color: #ffc107; font-size: 1.5rem;"></i> 
                        Puntos disponibles: <strong>{{ $puntos ? $puntos->puntosDisponibles : 0 }}</strong>
                    </p>
                    <p style="font-size: 1.2rem;">
                        <i class="fa fa-coins" style="color: #ffc107; font-size: 1.5rem;"></i> 
                        Puntos utilizados: <strong>{{ $puntos ? $puntos->puntosUtilizados : 0 }}</strong>
                        <button class="btn btn-outline-primary btn-sm ml-2">Ver detalles</button>
                    </p>

                    <!-- Botones Ganar y Canjear -->
                    <div class="mt-4">
                        <a href="{{ route('public.reciclaje') }}" class="btn btn-success btn-lg mr-3" id="ganar-btn">Historial de reciclaje</a>
                        <a href="{{ route('public.canjes') }}" class="btn btn-warning btn-lg">Canjear recompensas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>

<style>
    .sidebar {
        background-color: #212121;
        width: 100px;
        height: 100%;
        position: relative;
        transition: width 0.3s ease;
        overflow: hidden;
    }
    .sidebar:hover {
        width: 250px;
    }
    .sidebar-item:hover .sidebar-text {
        opacity: 1;
        visibility: visible;
    }
    .sidebar-text {
        opacity: 0;
        visibility: hidden;
        font-size: 0.9rem;
        transition: opacity 0.3s, visibility 0.3s;
    }
    .sidebar:hover .sidebar-text {
        opacity: 1;
        visibility: visible;
    }
    .card {
        border-radius: 15px;
        border: none;
    }
    .card-body {
        padding: 2rem;
    }
</style>
@endsection
