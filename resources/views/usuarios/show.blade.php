@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Usuario</h1>
        
        <p><strong>Nombre de Usuario:</strong> {{ $usuario->nombreUsuario }}</p>
        <p><strong>Tipo de Usuario:</strong> {{ $usuario->tipoUsuario }}</p>
        <p><strong>Correo Electrónico:</strong> {{ $usuario->email }}</p>

        <h4>Detalles de Persona</h4>
        <p><strong>Nombre:</strong> {{ $usuario->persona->nombre }}</p>
        <p><strong>Apellido:</strong> {{ $usuario->persona->apellido }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $usuario->persona->fechaNacimiento->format('d/m/Y') }}</p>
        <p><strong>Dirección:</strong> {{ $usuario->persona->direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $usuario->persona->telefono }}</p>
        <p><strong>Género:</strong> {{ $usuario->persona->genero }}</p>
        <p><strong>Foto:</strong> <img src="{{ asset('storage/' . $usuario->persona->foto) }}" alt="Foto de {{ $usuario->persona->nombre }}" width="150"></p>
        
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
