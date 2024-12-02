@extends('layouts.app')
@section('content')
<div>
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Información de escuela</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('public.escuela') }}">Escuela</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Información de escuela</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="col-lg-8">
                    
    
    <!-- Detalle de escuelas -->
    <div class="container-fluid py-5">
    <div class="pb-3">
    <div class="blog-item">
        <div class="position-relative">
        <div class="text-center mb-4">
    <img class="img-fluid" src="{{ asset('storage/' . $escuela->logoEscuela) }}" alt="Logo de {{ $escuela->nombreEscuela }}" style="max-width: 300px; height: auto;">
</div>
<div class="blog-date">
    <a href="{{ route('public.escuela') }}" class="btn btn-primary d-flex align-items-center">
        <i class="fa fa-arrow-left mr-2"></i>
    </a>
</div>

        </div>
    </div>
    <div class="bg-white mb-3" style="padding: 30px;">
        <h2 class="mb-3">{{ $escuela->nombreEscuela }}</h2>
        <p><strong>Dirección:</strong> {{ $escuela->direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $escuela->telefono }}</p>
        <p><strong>Director:</strong> {{ $escuela->director }}</p>
        
        <!-- Frase motivadora -->
        <h4 class="mb-3 text-primary">{{ $frase }}</h4>

        <!-- Google Maps -->
        <!-- Mostrar el mapa utilizando el enlace almacenado -->
<div class="text-center mt-4">
    <iframe 
        width="100%" 
        height="300" 
        frameborder="0" 
        style="border:0;" 
        src="{{ $escuela->direccionUrl }}" 
        allowfullscreen
    ></iframe>
    <a href="{{ $escuela->direccionLink }}" target="_blank" class="btn btn-primary mt-2">
        Ver en Google Maps
    </a>
</div>
    </div>
</div>
</div>

                
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

</div>

@endsection