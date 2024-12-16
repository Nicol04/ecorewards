@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Editar Usuario</h2>
            <a href="{{ route('usuarios.index') }}" class="btn btn-light btn-sm">Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Información del Usuario -->
                <h4 class="text-secondary mb-3">Información del Usuario</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="{{ old('nombreUsuario', $usuario->nombreUsuario) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tipoUsuario" class="form-label">Tipo de Usuario</label>
                        <select name="tipoUsuario" id="tipoUsuario" class="form-select" required>
                            @php
                                $tiposUsuario = [
                                    'Docente' => 'Docente',
                                    'Administrador' => 'Administrador',
                                    'Director' => 'Director',
                                    'Estudiante' => 'Estudiante',
                                ];
                            @endphp
                            @foreach ($tiposUsuario as $value => $label)
                                <option value="{{ $value }}" {{ old('tipoUsuario', $usuario->tipoUsuario) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Dejar en blanco para no cambiar la contraseña.</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <hr>

                <!-- Detalles de la Persona -->
                <h4 class="text-secondary mb-3">Detalles de Persona</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombrePersona" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombrePersona" name="nombrePersona" value="{{ old('nombrePersona', $usuario->persona->nombre) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidoPersona" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellidoPersona" name="apellidoPersona" value="{{ old('apellidoPersona', $usuario->persona->apellido) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento', $usuario->persona->fechaNacimiento->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $usuario->persona->direccion) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $usuario->persona->telefono) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="genero" class="form-label">Género</label>
                        <select class="form-select" id="genero" name="genero">
                            <option value="masculino" {{ old('genero', $usuario->persona->genero) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('genero', $usuario->persona->genero) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('genero', $usuario->persona->genero) == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
