@extends('layouts.app')
@section('content')
<div>
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Escuela</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('hogar') }}">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Escuela</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Escuela Inicio -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Escuelas</h6>
                <h1>Únete a la Revolución del Reciclaje con EcoRewards</h1>
                <h3>Descubre cómo los estudiantes de la institución están haciendo la diferencia mediante el reciclaje.</h3>
                <h1></h1>
                <div class="hero-overlay">
                    <div class="hero-content">
                        <h1></h1>
                        <p></p>
                        <a href="{{ route('public.comofunciona') }}" class="cta-button">Conoce más sobre EcoRewards</a>
                    </div>
                </div>
        </div>

    </div>
</div>
<!-- Escuela Fin -->


<!-- Sección del Colegio Participante -->

<div class="container">
    <h1 class="mb-4">Escuelas</h1>
    <p>Conoce a los colegios que forman parte del proyecto EcoRewards para fomentar prácticas sostenibles en sus estudiantes.</p>
    <div class="row">
        @foreach ($escuelas as $escuela)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="package-item bg-white mb-2">
                <a href="{{ route('public.informacion_escuelas', ['id' => $escuela->idEscuela]) }}"><img class="img-fluid" src="{{ asset('storage/' . $escuela->logoEscuela) }}" alt="Logo de {{ $escuela->nombreEscuela }}"></a>
                <div class="p-4">
                <a class="h5 text-decoration-none" href="{{ route('public.informacion_escuelas', ['id' => $escuela->idEscuela]) }}">{{ $escuela->nombreEscuela }}</a>
                <div class="d-flex justify-content-between mt-3 mb-3">
                        <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>{{ $escuela->direccion }}</small>
                        <small class="m-0"><i class="fa fa-phone text-primary mr-2"></i>{{ $escuela->telefono }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Sección del Punto de Recojo -->
<section id="punto-recojo" class="recycle-section">
    <div class="container">
        <div class="text-content" data-aos="fade-up">
            <h2>Punto de Recojo en el Colegio</h2>
            <p>Hemos habilitado una estación de reciclaje cerca del patio principal de tu escuela, donde pueden depositar materiales reciclables y recibir puntos en EcoRewards.</p>
            <ul>
                <li><strong>Ubicación:</strong> Cerca del patio principal</li>
                <li><strong>Materiales aceptados:</strong> Papel, plástico, vidrio</li>
                <li><strong>Horarios de operación:</strong> Varían según la institución.</li>
            </ul>
        </div>
        <div class="image-content" data-aos="fade-up">
            <div class="row text-center">
                <!-- Primera imagen -->
                <div class="col-md-6">
                    <img src="{{ asset('static/img/punto-recojo.jpg') }}" alt="Punto de Recojo" class="img-fluid" style="height: 300px;">
                </div>

                <!-- Segunda imagen -->
                <div class="col-md-6">
                    <img src="{{ asset('static/img/tachos.png') }}" alt="Tachos de reciclaje" class="img-fluid" style="height: 350px;">
                </div>
            </div>

        </div>
</section>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>
@endsection