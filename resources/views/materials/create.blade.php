<!-- resources/views/materials/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Material</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materials.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombreMaterial" class="form-label">Nombre</label>
            <input type="text" name="nombreMaterial" id="nombreMaterial" class="form-control" value="{{ old('nombreMaterial') }}" required>
        </div>
        <div class="mb-3">
            <label for="precioKg" class="form-label">Precio (Kg)</label>
            <input type="number" name="precioKg" id="precioKg" class="form-control" value="{{ old('precioKg') }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection