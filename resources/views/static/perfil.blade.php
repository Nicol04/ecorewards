@extends('layouts.app')
@section('content')
<div class="d-flex">
    <!-- Panel lateral -->
    <div class="sidebar d-flex flex-column justify-content-center align-items-center">

        <!-- Opción: Configuración -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Configuración">
            <i class="fa fa-cog" style="color: #ffffff; font-size: 1.5rem; transition: transform 0.3s;"></i>
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
            <a href="{{ route('public.historial_canjes') }}"><i class="fa fa-gift" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Recompensas</span>
        </div>

        <!-- Opción: Reciclaje -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Reciclaje">
        <a href="{{ route('public.reciclaje') }}"><i class="fa fa-recycle" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Reciclaje</span>
        </div>


    </div>

    <!-- Contenido principal -->
    <div class="d-flex">
        <!-- Perfil inicio (a la izquierda) -->
        <div class="d-flex flex-column text-center bg-white mb-5 py-5 px-4" style="width: 40%; padding-right: 20px; padding-left: 20px; margin-right: 20px;">
            <!-- Estado activo y botón de configuración -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <span class="badge" style="background-color: #00f600; border-radius: 50%; width: 20px; height: 20px; display: inline-block;"></span>
                    <span class="ml-2">Activo</span>
                </div>
                <!-- Botón de configuración -->
                <a href="" class="btn-configuracion">
                    <i class="bi bi-pencil-fill" style="font-size: 1.2rem;"></i>
                </a>
            </div>

            <!-- Nombre de Usuario -->
            <h3 class="text-primary mb-3" style="font-size: 2rem;">{{ $usuario->nombreUsuario }}</h3>

            <!-- Foto del perfil -->
            <img src="{{ $usuario->empleado && $usuario->empleado->foto ? Storage::url($usuario->empleado->foto) : asset('assets/img/usuario.png') }}"
                class="img-fluid mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Foto de {{ $usuario->nombreUsuario }}">

            <!-- Nombre y Apellido -->
            <h5 class="text-primary mb-3" style="font-size: 1.5rem;">{{ $persona->nombre }} {{ $persona->apellido }}</h5>

            <!-- Descripción con el tipo de usuario -->
            <p>{{ $usuario->tipoUsuario }}</p>
        </div>
        <!-- Perfil fin -->

        <!-- Datos del Usuario -->
        <div class="d-flex flex-wrap" style="width: 60%;">

            <!-- Primera fila (3 columnas) -->
            <div class="service-item bg-white text-center mb-2 py-4 px-4" style="width: 30%; margin-right: 1%; margin-bottom: 15px;">
                <i class="fa fa-calendar-alt fa-2x mx-auto mb-4 icon-hover"></i>
                <h5 class="mb-2">Fecha de Nacimiento</h5>
                <p class="m-0">{{ \Carbon\Carbon::parse($persona->fechaNacimiento)->format('d/m/Y') }}</p>
                <p class="m-0">
                    @php
                    $edad = \Carbon\Carbon::parse($persona->fechaNacimiento)->age;
                    @endphp
                    Edad: {{ $edad }} años
                </p>
            </div>

            <div class="service-item bg-white text-center mb-2 py-4 px-4" style="width: 30%; margin-right: 1%; margin-bottom: 15px;">
                <i class="fa fa-map-marker-alt fa-2x mx-auto mb-4 icon-hover"></i>
                <h5 class="mb-2">Dirección</h5>
                <p class="m-0">{{ $persona->direccion }}</p>
            </div>

            <div class="service-item bg-white text-center mb-2 py-4 px-4" style="width: 30%; margin-right: 1%; margin-bottom: 15px;">
                <i class="fa fa-phone-alt fa-2x mx-auto mb-4 icon-hover"></i>
                <h5 class="mb-2">Teléfono</h5>
                <p class="m-0">{{ $persona->telefono }}</p>
            </div>

            <!-- Segunda fila -->
            <div class="service-item bg-white text-center mb-2 py-4 px-4" style="width: 30%; margin-right: 1%; margin-bottom: 15px;">
                <i class="fa fa-venus-mars fa-2x mx-auto mb-4 icon-hover"></i>
                <h5 class="mb-2">Género</h5>
                <p class="m-0">{{ $persona->genero }}</p>
            </div>

            <div class="service-item bg-white text-center mb-2 py-4 px-4" style="width: 30%; margin-right: 1%; margin-bottom: 15px;">
                <i class="fa fa-envelope fa-2x mx-auto mb-4 icon-hover"></i>
                <h5 class="mb-2">Email</h5>
                <p class="m-0">{{ $usuario->email }}</p>
            </div>

            @if($usuario->tipoUsuario !== 'Administrador')
            @foreach($persona->escuelas as $escuela)
            <div class="service-item bg-white text-center mb-2 py-4 px-4" style="width: 30%; margin-right: 1%; margin-bottom: 15px;">
                <i class="fa fa-school fa-2x mx-auto mb-4 icon-hover"></i>
                <h5 class="mb-2">Escuela</h5>
                <p class="m-0">{{ $escuela->nombreEscuela }}</p>
            </div>
            @endforeach
            @endif

        </div>
    </div>
    <style>
    /* Estilo inicial del botón */
    .btn-configuracion {
        background-color: #79b630; /* Color de fondo inicial */
        color: white; /* Color del ícono inicial */
        border-radius: 50%; /* Botón circular */
        width: 40px; /* Tamaño del botón */
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, color 0.3s; /* Transición suave */
    }

    /* Estilo al pasar el cursor */
    .btn-configuracion:hover {
        background-color: #212121; /* Cambia el fondo a blanco */
        color: #7ab730; /* Cambia el ícono a verde */
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