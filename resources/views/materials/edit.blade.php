<!-- resources/views/materials/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Material</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materials.update', $material->idMaterial) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombreMaterial" class="form-label">Nombre</label>
            <input type="text" name="nombreMaterial" id="nombreMaterial" class="form-control" value="{{ old('nombreMaterial', $material->nombreMaterial) }}" required>
        </div>
        <div class="mb-3">
            <label for="precioKg" class="form-label">Precio (Kg)</label>
            <input type="number" name="precioKg" id="precioKg" class="form-control" value="{{ old('precioKg', $material->precioKg) }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection