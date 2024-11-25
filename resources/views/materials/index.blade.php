<!-- resources/views/materials/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Materiales</h1>
    <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Crear Material</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Precio (Kg)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->idMaterial }}</td>
                    <td>{{ $material->nombreMaterial }}</td>
                    <td>{{ $material->precioKg }}</td>
                    <td>
                        <a href="{{ route('materials.show', $material->idMaterial) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('materials.edit', $material->idMaterial) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('materials.destroy', $material->idMaterial) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
