<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets/style/style_register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    
    <style>
        /* Agregar algunos estilos extra para mejorar los inputs */
        .input-container {
            position: relative;
        }

        .input-container input,
        .input-container select {
            padding-left: 30px;
            /* Para dejar espacio para el icono */
        }

        .input-container i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .form-group select,
        .form-group input[type="date"],
        .form-group input[type="file"] {
            padding-left: 30px;
            /* Para acomodar el icono */
        }
    </style>
</head>

<body>
    @if ($errors->any())
        <div style="display: none;"></div> <!-- Oculta el contenedor global si ya no es necesario -->
    @endif
    @if (($message = Session::get('mensaje')) && ($icono = Session::get('icono')))
        <script>
            Swal.fire({
                title: "Mensaje",
                text: "{{ $message }}",
                icon: "{{ $icono }}"
            });
        </script>
    @endif

    <div class="register-container">
        <!-- Imagen Motivacional -->
        <div class="motivational-container">
            <img src="{{ asset('assets/img/registro.png') }}" alt="Reciclaje" class="motivational-image">
            <p class="motivational-phrase">"Cada paso cuenta, y el tuyo puede cambiar el mundo."</p>
            <p class="footer">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
        </div>

        <!-- Formulario de Registro -->
        <div class="container">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                style="max-width: 80%; height: auto; margin-bottom: 20px;">

            <h2>¡Wait {{ Auth::user()->nombreUsuario }}! ✋</h2>
            <h2>Aún nos falta conocer más sobre tí</h2>

            <form method="POST" action="{{ route('registro-persona.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Nombre y Apellido -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre" class="font-weight-bold">Nombre</label>
                        <div class="input-container">
                            <i class="fa fa-user"></i>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                id="nombre" name="nombre" value="{{ old('nombre') }}"
                                placeholder="Ingresa tu nombre" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido" class="font-weight-bold">Apellido</label>
                        <div class="input-container">
                            <i class="fa fa-user"></i>
                            <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                id="apellido" name="apellido" value="{{ old('apellido') }}"
                                placeholder="Ingresa tu apellido" required>
                            @error('apellido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha de Nacimiento y Dirección -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fechaNacimiento" class="font-weight-bold">Fecha de Nacimiento</label>
                            <div class="input-container">
                                <i class="fa fa-calendar-alt"></i>
                                <input type="date"
                                    class="form-control @error('fechaNacimiento') is-invalid @enderror"
                                    id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}"
                                    required>
                            </div>
                            @error('fechaNacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccion" class="font-weight-bold">Dirección</label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                id="direccion" name="direccion" value="{{ old('direccion') }}"
                                placeholder="Ingresa tu dirección" required>
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Teléfono y Género -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono" class="font-weight-bold">Teléfono</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                id="telefono" name="telefono" value="{{ old('telefono') }}"
                                placeholder="Ingresa tu teléfono" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="genero" class="font-weight-bold">Género</label>
                            <div class="input-container">
                                <i class="fa fa-genderless"></i>
                                <select class="form-control @error('genero') is-invalid @enderror" id="genero"
                                    name="genero" required>
                                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>
                                        Masculino</option>
                                    <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>
                                        Femenino
                                    </option>
                                    <option value="otro" {{ old('genero') == 'otro' ? 'selected' : '' }}>Otro
                                    </option>
                                </select>
                            </div>
                            @error('genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="form-group">
                        <label for="foto" class="font-weight-bold">Foto (opcional)</label>
                        <div class="input-container">
                            <i class="fa fa-camera"></i>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                                id="foto" name="foto" accept="image/*" required>
                        </div>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Escuela -->
                    <div class="form-group">
                        <label for="idescuela" class="font-weight-bold">Escuela</label>
                        <div class="input-container">
                            <i class="fa fa-school"></i>
                            <select class="form-control @error('idescuela') is-invalid @enderror" id="idescuela"
                                name="idescuela" required>
                                @foreach ($escuelas as $escuela)
                                    <option value="{{ $escuela->idEscuela }}"
                                        {{ old('idEscuela') == $escuela->idEscuela ? 'selected' : '' }}>
                                        {{ $escuela->nombreEscuela }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('idEscuela')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Información de la Escuela -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="grado" class="font-weight-bold">Grado</label>
                            <select class="form-control @error('grado') is-invalid @enderror" id="grado"
                                name="grado" required>
                                <option value="1" {{ old('grado') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('grado') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('grado') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('grado') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('grado') == '5' ? 'selected' : '' }}>5</option>
                            </select>
                            @error('grado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="seccion" class="font-weight-bold">Sección</label>
                            <select class="form-control @error('seccion') is-invalid @enderror" id="seccion"
                                name="seccion" required>
                                <option value="A" {{ old('seccion') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('seccion') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ old('seccion') == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ old('seccion') == 'D' ? 'selected' : '' }}>D</option>
                            </select>
                            @error('seccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Escuela -->
                    <div class="form-group">
                        <label for="idescuela" class="font-weight-bold">Escuela</label>
                        <select class="form-control @error('idescuela') is-invalid @enderror" id="idescuela"
                            name="idescuela" required>

                            @foreach ($escuelas as $escuela)
                                <option value="{{ $escuela->idEscuela }}"
                                    {{ old('idEscuela') == $escuela->idEscuela ? 'selected' : '' }}>
                                    {{ $escuela->nombreEscuela }}
                                </option>
                            @endforeach
                        </select>
                        @error('idEscuela')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Botón de Enviar -->
                    <div class="form-group text-center">
                        <button type="submit" class="login-button">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
