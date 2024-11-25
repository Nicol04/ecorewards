<div class="form-group">
    <label for="nombreUsuario">Nombre de Usuario</label>
    <input type="text" name="nombreUsuario" class="form-control"
        value="{{ old('nombreUsuario', $usuario->nombreUsuario ?? '') }}" required>
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
    <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email ?? '') }}"
        required>
</div>

<div class="form-group">
    <label for="password">Contraseña</label>
    <input type="password" name="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
</div>

<div class="form-group">
    <label for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
</div>

<hr>

<h2>Información Personal</h2>
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $persona->nombre ?? '') }}"
        required>
</div>

<div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $persona->apellido ?? '') }}"
        required>
</div>

<div class="form-group">
    <label for="fechaNacimiento">Fecha de Nacimiento</label>
    <input type="date" name="fechaNacimiento" class="form-control"
        value="{{ old('fechaNacimiento', isset($persona) ? \Carbon\Carbon::parse($persona->fechaNacimiento)->format('Y-m-d') : '') }}" required>
</div>


<div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" class="form-control"
        value="{{ old('direccion', $persona->direccion ?? '') }}">
</div>

<div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $persona->telefono ?? '') }}">
</div>

<div class="form-group">
    <label for="genero">Género</label>
    <select name="genero" class="form-control" required>
        <option value="M" {{ old('genero', $persona->genero ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
        <option value="F" {{ old('genero', $persona->genero ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
    </select>
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" class="form-control">
    @if (!empty($persona->foto))
        <p>Foto actual: <img src="{{ asset('storage/' . $persona->foto) }}" alt="Foto" width="100"></p>
    @endif
</div>
