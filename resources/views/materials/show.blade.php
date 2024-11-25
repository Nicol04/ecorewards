<!-- resources/views/materials/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Material</h1>

    <div class="mb-3">
        <label class="form-label">Nombre:</label>
        <p>{{ $material->nombreMaterial }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio (Kg):</label>
        <p>{{ $material->precioKg }}</p>
    </div>

    <a href="{{ route('materials.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection