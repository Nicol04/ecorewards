@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuario</h1>

        <form action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombreUsuario">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="{{ old('nombreUsuario', $usuario->nombreUsuario) }}" required>
            </div>

            <div class="form-group">
                <label for="tipoUsuario">Tipo de Usuario</label>
                <select name="tipoUsuario" id="tipoUsuario" class="form-control" required>
                    @php
                        // Lista de opciones disponibles
                        $tiposUsuario = [
                            'Docente' => 'Docente',
                            'Administrador' => 'Administrador',
                            'Director' => 'Director',
                            'Estudiante' => 'Estudiante',
                        ];
                    @endphp
            
                    @foreach ($tiposUsuario as $value => $label)
                        <option value="{{ $value }}"
                            {{ old('tipoUsuario', $usuario->tipoUsuario ?? '') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <hr>

            <h4>Detalles de Persona</h4>

            <div class="form-group">
                <label for="nombrePersona">Nombre</label>
                <input type="text" class="form-control" id="nombrePersona" name="nombrePersona" value="{{ old('nombrePersona', $usuario->persona->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="apellidoPersona">Apellido</label>
                <input type="text" class="form-control" id="apellidoPersona" name="apellidoPersona" value="{{ old('apellidoPersona', $usuario->persona->apellido) }}" required>
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento', $usuario->persona->fechaNacimiento->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $usuario->persona->direccion) }}">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $usuario->persona->telefono) }}">
            </div>

            <div class="form-group">
                <label for="genero">Género</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="masculino" {{ old('genero', $usuario->persona->genero) == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ old('genero', $usuario->persona->genero) == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ old('genero', $usuario->persona->genero) == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        </form>
    </div>
@endsection
