@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-primary">Gestión de Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-4">Crear Usuario</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-5">
            <h2>Administradores</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre de Usuario</th>
                        <th>Nombre de Persona</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios->where('tipoUsuario', 'Administrador') as $usuario)
                        <tr>
                            <td>{{ $usuario->nombreUsuario }}</td>
                            <td>{{ $usuario->persona ? $usuario->persona->nombre : 'No asignado' }}</td>
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn btn-info btn-sm">Ver</a>
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

        <div class="mb-5">
            <h2>Estudiantes</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre de Usuario</th>
                        <th>Nombre de Persona</th>
                        <th>IE</th>
                        <th>Grado</th>
                        <th>Sección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios->where('tipoUsuario', 'Estudiante') as $usuario)
                        <tr>
                            <td>{{ $usuario->nombreUsuario }}</td>
                            <td>{{ $usuario->persona ? $usuario->persona->nombre : 'No asignado' }}</td>
                            <td>
                                @forelse ($usuario->persona->escuelas ?? [] as $escuela)
                                    <p>{{ $escuela->nombreEscuela }}</p>
                                @empty
                                    <p>No tiene escuelas asociadas.</p>
                                @endforelse
                            </td>
                            <td>{{ $usuario->persona->grado ?? 'N/A' }}</td>
                            <td>{{ $usuario->persona->seccion ?? 'N/A' }}</td>
                            <td>{{ $usuario->persona->fechaNacimiento ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn btn-info btn-sm">Ver</a>
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

        <div class="mb-5">
            <h2>Docentes</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre de Usuario</th>
                        <th>Nombre de Persona</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios->where('tipoUsuario', 'Docente') as $usuario)
                        <tr>
                            <td>{{ $usuario->nombreUsuario }}</td>
                            <td>{{ $usuario->persona ? $usuario->persona->nombre : 'No asignado' }}</td>
                            <td>
                                <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('usuarios.show', $usuario->idUsuario) }}" class="btn btn-info btn-sm">Ver</a>
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
    </div>
@endsection
