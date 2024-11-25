@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Tipo de Usuario</th>
                    <th>Nombre de Persona</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nombreUsuario }}</td>
                        <td>{{ $usuario->tipoUsuario }}</td>
                        <td>{{ $usuario->persona ? $usuario->persona->nombre : 'No asignado' }}</td>
                        <td>
                            <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn border-stone-100 btn-sm">ver</a>
                            
                            <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
