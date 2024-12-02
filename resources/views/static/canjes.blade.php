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
        <a href="{{ route('public.historial_canjes') }}"><i class="fa fa-gift" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Recompensas</span>
        </div>

        <!-- Opción: Reciclaje -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Reciclaje">
            <a href="{{ route('public.reciclaje') }}"><i class="fa fa-recycle" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Reciclaje</span>
        </div>
    </div>

    <div class="container">
        <!-- Inicio Recompensas -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="row">
                    <!-- Columna Principal -->
                    <div class="col-lg-8">
                    <h1 class="text-primary">
                        <i class="fa fa-exchange-alt"></i> Canjes
                    </h1>
                        <div class="row pb-3">
                            @foreach ($recompensas as $recompensa)
                            <div class="col-md-6 mb-4">
                                <div class="blog-item bg-white rounded shadow-sm p-3">
                                    <div class="position-relative">
                                        @if (!empty($recompensa->imagen))
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $recompensa->imagen) }}" alt="Imagen de recompensa" style="height: 250px; object-fit: contain; background-color: #f8f9fa; border-radius: 8px;">
                                        @else
                                        <img class="img-fluid w-100" src="img/recompensas/imagen_default.jpg" alt="Imagen por defecto" style="height: 250px; object-fit: contain; background-color: #f8f9fa; border-radius: 8px;">
                                        @endif
                                        <div class="blog-date">
                                            <h6 class="font-weight-bold mb-n1">{{ $recompensa->puntosRequeridos }}</h6>
                                            <small class="text-white text-uppercase">Puntos</small>
                                        </div>
                                    </div>
                                    <div class="bg-white p-4">
                                        <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none" href="{{ route('public.informacion_recompensas', $recompensa->idRecompensa) }}">
                                        {{ $recompensa->nombreRecompensa }}
                                    </a>                      
                      <span class="text-primary px-2">|</span>
                                            <a class="text-primary text-uppercase text-decoration-none" href="#">{{ $recompensa->categorium->nombreCategoria }}</a>
                                        </div>
                                        <p class="m-0">{{ $recompensa->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Paginación -->
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-lg justify-content-center bg-white mb-0" style="padding: 30px;">
                                    <!-- Página anterior -->
                                    @if ($recompensas->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                                    </li>
                                    @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $recompensas->appends(['categoria' => request('categoria')])->previousPageUrl() }}">&laquo;</a>
                                    </li>
                                    @endif

                                    <!-- Páginas intermedias -->
                                    @foreach ($recompensas->getUrlRange(1, $recompensas->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $recompensas->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}{{ request('categoria') ? '&categoria=' . request('categoria') : '' }}">{{ $page }}</a>
                                    </li>
                                    @endforeach

                                    <!-- Página siguiente -->
                                    @if ($recompensas->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $recompensas->appends(['categoria' => request('categoria')])->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                    @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&raquo;</a>
                                    </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>

                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-lg-4">
                        <!-- Biografía -->
                        <div class="d-flex flex-column text-center bg-white mb-5 py-5 px-4">
                            <h3 class="text-primary mb-3">Recompensas</h3>
                            <p>En este apartado encontrarás los objetos que puedes canjear.</p>
                        </div>

                        <!-- Lista de Categorías -->
                        <div class="mb-5">
                            <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Categorías</h4>
                            <div class="bg-white" style="padding: 30px;">
                                <ul class="list-inline m-0">
                                    @foreach($categorias as $categoria)
                                    <li class="mb-3 d-flex justify-content-between align-items-center">
                                        <a class="text-dark"
                                            href="{{ route('public.canjes', ['categoria' => $categoria->idCategoria]) }}"
                                            class="{{ isset($categoriaId) && $categoriaId == $categoria->idCategoria ? 'font-weight-bold' : '' }}">
                                            <i class="fa fa-angle-right text-primary mr-2"></i>{{ $categoria->nombreCategoria }}
                                        </a>
                                        <span class="badge badge-primary badge-pill">{{ $categoria->recompensa_count }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('public.historial_canjes') }}" class="btn btn-success btn-lg mr-3" id="historial_canje"><i class="fa fa-exchange-alt"></i> Recompensas canjeadas</a>
                        </div>
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