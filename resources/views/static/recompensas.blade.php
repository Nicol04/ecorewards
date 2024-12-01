@extends('layouts.app')
@section('content')
<div>
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Recompensas</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('hogar') }}">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Recompensas</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Inicio Recompensas -->
    <div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <!-- Columna Principal -->
            <div class="col-lg-8">
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
                                    <a class="text-primary text-uppercase text-decoration-none" href="#">{{ $recompensa->nombreRecompensa }}</a>
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
                            @if ($recompensas->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $recompensas->previousPageUrl() }}">&laquo;</a>
                            </li>
                            @endif

                            @foreach ($recompensas->getUrlRange(1, $recompensas->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $recompensas->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                            @endforeach

                            @if ($recompensas->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $recompensas->nextPageUrl() }}">&raquo;</a>
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
                    <p>En este apartado encontrarás los objetos que puedes cambiar.</p>
                </div>

                <!-- Formulario de búsqueda -->
                <div class="mb-5">
                    <div class="bg-white" style="padding: 30px;">
                        <div class="input-group">
                            <input type="text" class="form-control p-4" placeholder="Búsqueda">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Categorías -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Categorías</h4>
                    <div class="bg-white" style="padding: 30px;">
                        <ul class="list-inline m-0">
                            @foreach($categorias as $categoria)
                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="#">
                                    <i class="fa fa-angle-right text-primary mr-2"></i>{{ $categoria->nombreCategoria }}
                                </a>
                                <span class="badge badge-primary badge-pill">{{ $categoria->recompensa_count }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Recent Post -->
                <div class="mb-5">
                        <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Canjes recientes:</h4>
                        <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                            <img class="img-fluid" src="img/cliente.png" height="100" width="100" alt="">
                            <div class="pl-3">
                                <h6 class="m-1">Canjeó el 10/10/2024 una mochila capybara</h6>
                                <small>Mariano Rojo</small>
                            </div>
                        </a>
                        <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                            <img class="img-fluid" src="img/cliente1.jpg" height="100" width="100" alt="">
                            <div class="pl-3">
                                <h6 class="m-1">Canjeó el 04/10/2024 unos audifonos Sony inalámbricos</h6>
                                <small>Lucía Pineda</small>
                            </div>
                        </a>
                        <a class="d-flex align-items-center text-decoration-none bg-white mb-3" href="">
                            <img class="img-fluid" src="img/cliente2.png" height="100" width="100" alt="">
                            <div class="pl-3">
                                <h6 class="m-1">Canjeó el 04/10/2024 un mouse gaming gamer color azul</h6>
                                <small>Sebastián García</small>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>

    <!-- Fin Recompensas -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

</div>
@endsection