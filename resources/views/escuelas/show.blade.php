@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Detalles de la Escuela</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $escuela->nombreEscuela }}</h5>
            <p class="card-text"><strong>Dirección:</strong> {{ $escuela->direccion ?? 'No especificada' }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $escuela->telefono ?? 'No especificado' }}</p>
            <p class="card-text"><strong>Director:</strong> {{ $escuela->director ?? 'No especificado' }}</p>
            <p class="card-text"><strong>Logo:</strong></p>
            @if($escuela->logoEscuela)
                <img src="{{ asset('storage/' . $escuela->logoEscuela) }}" alt="Logo de la escuela" style="max-width: 200px;">
            @else
                <p>No hay logo disponible.</p>
            @endif
            <a href="{{ route('escuelas.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection
