@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Detalles del Usuario</h2>
            <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-sm">Volver</a>
        </div>
        <div class="card-body">
            <!-- Información principal del usuario -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Nombre de Usuario:</strong> {{ $usuario->nombreUsuario }}</p>
                    <p><strong>Tipo de Usuario:</strong> <span class="badge bg-info text-dark">{{ $usuario->tipoUsuario }}</span></p>
                    <p><strong>Correo Electrónico:</strong> {{ $usuario->email }}</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . $usuario->persona->foto) }}" alt="Foto de {{ $usuario->persona->nombre }}" class="img-thumbnail rounded-circle" width="150">
                </div>
            </div>

            <!-- Detalles personales -->
            <h4 class="text-secondary mb-3">Detalles de Persona</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> {{ $usuario->persona->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $usuario->persona->apellido }}</p>
                    <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->persona->fechaNacimiento->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Dirección:</strong> {{ $usuario->persona->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $usuario->persona->telefono }}</p>
                    <p><strong>Género:</strong> {{ ucfirst($usuario->persona->genero) }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
