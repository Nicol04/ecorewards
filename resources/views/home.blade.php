@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <!-- Sección de Reciclaje -->
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">Reciclaje y Ganancias</h2>
        
        <!-- Fila con 3 columnas para los materiales -->
        <div class="row justify-content-center">
            <!-- Columna para Cartón -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('static/img/carton.png') }}" class="card-img-top" alt="Cartón">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cartón</h5>
                        <p class="card-text">Gana <strong>100 puntos</strong> por cada <strong>1 kg</strong> de cartón reciclado.</p>
                    </div>
                </div>
            </div>
            
            <!-- Columna para Plástico -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('static/img/plastico.png') }}" class="card-img-top" alt="Plástico">
                    <div class="card-body text-center">
                        <h5 class="card-title">Plástico</h5>
                        <p class="card-text">Gana <strong>90 puntos</strong> por cada <strong>1 kg</strong> de plástico reciclado.</p>
                    </div>
                </div>
            </div>
            
            <!-- Columna para Papel -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('static/img/papel.png') }}" class="card-img-top" alt="Papel">
                    <div class="card-body text-center">
                        <h5 class="card-title">Papel</h5>
                        <p class="card-text">Gana <strong>70 puntos</strong> por cada <strong>1 kg</strong> de papel reciclado.</p>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="card-title">¡Organiza tus residuos en diferentes recipientes antes de entregarlos a EcoRewards!</h5>
        <p class="text-success text-center">Acércate a la estación de tu institución llevando tu reciclaje.</p>
    </div>
    <!-- Fin de Reciclaje -->

</div>
@endsection