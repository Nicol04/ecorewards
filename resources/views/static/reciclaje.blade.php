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
            <a href="{{ route('public.puntos') }}"><i class="fa fa-star" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Puntos</span>
        </div>
        <!-- Opción: Recompensas -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Recompensas">
            <i class="fa fa-gift" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i>
            <span class="sidebar-text mt-2">Recompensas</span>
        </div>
        <!-- Opción: Reciclaje -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Reciclaje">
            <i class="fa fa-recycle" style="color: #ffffff; font-size: 1.5rem; transition: transform 0.3s;"></i>
            <span class="sidebar-text mt-2">Reciclaje</span>
        </div>
    </div>

    <!-- Sección de Reciclaje -->
    <div class="container mt-5">
        <h1 class="text-primary">
            <i class="fa fa-trash-alt" style="color: #7ab730; margin-right: 10px;"></i>
            Tu Historial de Reciclaje
        </h1>

        @if($reciclajes->isEmpty())
        <div class="alert alert-info text-center">
            <h3>Aún no has reciclado</h3>
            <p>¡Comienza a reciclar hoy mismo! Obtén maravillosas recompensas y ayuda a cuidar el medio ambiente.</p>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Fecha</th>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th>Puntos Obtenidos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reciclajes as $reciclaje)
                    <tr>
                        <td>{{ $reciclaje->fechaReciclaje->format('d-m-Y') }}</td>
                        <td>{{ $reciclaje->material->nombreMaterial }}</td>
                        <td>{{ $reciclaje->cantidad }}</td>
                        <td>{{ $reciclaje->puntosObtenidos }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Total de Puntos -->
        <div class="text-end mt-3">
            <h4 class="text-success">Total de Puntos:
                <strong>{{ $reciclajes->sum('puntosObtenidos') }}</strong>
            </h4>
        </div>
        @endif
        <h5 class="card-title" style="color: #578322;">Sigue reciclando para canjear fabulosas recompensas!</h5>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>

<style>
    .alert {
        border-radius: 15px;
        padding: 20px;
    }

    table {
        margin-top: 20px;
    }

    .text-end {
        text-align: right;
    }

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
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
    }
</style>

@endsection