@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Recompensa</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $recompensa->nombreRecompensa }}</h5>
            <p class="card-text">Descripción: {{ $recompensa->descripcion }}</p>
            <p class="card-text">Puntos Requeridos: {{ $recompensa->puntosRequeridos }}</p>
            <p class="card-text">Stock: {{ $recompensa->stock }}</p>
            <p class="card-text">Categoría: {{ $recompensa->categorium->nombreCategoria ?? 'Sin categoría' }}</p>
            <img src="{{ asset('storage/' . $recompensa->imagen) }}" alt="Imagen de la recompensa">
            <a href="{{ route('recompensas.index') }}" class="btn btn-secondary">Volver</a>

        </div>
    </div>
</div>
@endsection