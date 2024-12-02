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
            <i class="fa fa-exchange-alt" style="color: #ffffff; font-size: 1.5rem; transition: transform 0.3s;"></i>
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
            <a href="{{ route('public.reciclaje') }}"><i class="fa fa-recycle" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Reciclaje</span>
        </div>
    </div>

    <div class="container">
    <h1 class="text-primary">
    <i class="fa fa-exchange-alt"></i> Historial de Canjes
</h1>


        <!-- Comprobar si no hay canjes -->
        @if($canjes->isEmpty())
        <div class="alert alert-info">
            <p>¡Aún no has realizado ningún canje! Puedes canjear diferentes recompensas, todo depende de qué tanto recicles.</p>
        </div>
        @else
        <div class="row">
            @foreach($canjes as $canje)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-item bg-white mb-2">
                    <!-- Imagen de la recompensa -->
                    @if (!empty($canje->recompensa->imagen))
                    <img class="img-fluid w-100" src="{{ asset('storage/' . $canje->recompensa->imagen) }}" alt="Imagen de recompensa" style="height: 250px; object-fit: contain; background-color: #f8f9fa; border-radius: 8px;">
                    @else
                    <img class="img-fluid w-100" src="img/recompensas/imagen_default.jpg" alt="Imagen por defecto" style="height: 250px; object-fit: contain; background-color: #f8f9fa; border-radius: 8px;">
                    @endif

                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>{{ $canje->usuario->nombreUsuario }}</small>
                            <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>{{ $canje->fechaCanje->format('d-m-Y') }}</small>
                            <small class="m-0"><i class="fa fa-cogs text-primary mr-2"></i>{{ $canje->recompensa->categoria }}</small>
                        </div>
                        <!-- Nombre de la recompensa -->
                        <a class="h5 text-decoration-none" href="">{{ $canje->recompensa->nombreRecompensa }}</a>
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex justify-content-between">
                                <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>{{ $canje->puntuacion ?? 'Sin Puntuación' }} <small>({{ $canje->totalOpiniones ?? '0' }})</small></h6>
                                <h5 class="m-0">{{ $canje->puntosUtilizados }} Puntos</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

</div>
<style>
    /* Estilo inicial del botón */
    .btn-configuracion {
        background-color: #79b630;
        /* Color de fondo inicial */
        color: white;
        /* Color del ícono inicial */
        border-radius: 50%;
        /* Botón circular */
        width: 40px;
        /* Tamaño del botón */
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, color 0.3s;
        /* Transición suave */
    }

    /* Estilo al pasar el cursor */
    .btn-configuracion:hover {
        background-color: #212121;
        /* Cambia el fondo a blanco */
        color: #7ab730;
        /* Cambia el ícono a verde */
    }

    .sidebar {
        background-color: #212121;
        width: 100px;
        /* Ancho inicial */
        height: 100%;
        position: relative;
        transition: width 0.3s ease;
        /* Transición suave para el ancho */
        overflow: hidden;
    }

    /* Expande el panel cuando el cursor pasa por encima */
    .sidebar:hover {
        width: 250px;
        /* Ancho al pasar el cursor */
    }

    /* Mostrar los textos cuando el panel se expanda */
    .sidebar-item:hover .sidebar-text {
        opacity: 1;
        visibility: visible;
    }

    .sidebar-text {
        opacity: 0;
        visibility: hidden;
        font-size: 0.9rem;
        transition: opacity 0.3s, visibility 0.3s;
        /* Transición suave */
    }

    /* Hacer visible el texto cuando el panel se expanda */
    .sidebar:hover .sidebar-text {
        opacity: 1;
        visibility: visible;
    }

    /* Ajuste de tamaño de los cuadros */
    .service-item {
        width: 32%;
        /* Incrementado desde 30% */
        margin-right: 1%;
        margin-bottom: 15px;
        box-sizing: border-box;
        /* Asegura que el padding no afecte el tamaño */
    }

    .service-item p {
        word-break: break-word;
        /* Rompe el texto si es demasiado largo */
    }
</style>
@endsection