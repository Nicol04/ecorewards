@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombreUsuario">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="{{ old('nombreUsuario') }}" required>
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
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <hr>

            <h4>Detalles de Persona</h4>

            <div class="form-group">
                <label for="nombrePersona">Nombre</label>
                <input type="text" class="form-control" id="nombrePersona" name="nombrePersona" value="{{ old('nombrePersona') }}" required>
            </div>

            <div class="form-group">
                <label for="apellidoPersona">Apellido</label>
                <input type="text" class="form-control" id="apellidoPersona" name="apellidoPersona" value="{{ old('apellidoPersona') }}" required>
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div class="form-group">
                <label for="genero">Género</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>

            <button type="submit" class="btn btn-primary">Crear Usuario</button>
        </form>
    </div>
@endsection
