<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets/style/style_register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @if ($errors->any())
    <div style="display: none;"></div> <!-- Oculta el contenedor global si ya no es necesario -->
    @endif
    @if ( ($message = Session::get('mensaje')) && ($icono = Session::get('icono')) )
    <script>
        Swal.fire({
            title: "Mensaje",
            text: "{{$message}}",
            icon: "{{$icono}}"
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
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="max-width: 80%; height: auto; margin-bottom: 20px;">
            <h2>Regístrate y únete al cambio</h2>
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="input-container">
                    <i class="fa fa-user"></i>
                    <input id="nombreUsuario" type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" maxlength="12" value="{{ old('nombreUsuario') }}" placeholder="Ingresa un nombre de usuario" required autofocus>
                </div>
                @error('nombreUsuario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <small id="usernameCounter" class="char-counter">12 caracteres restantes</small>

                <!-- JavaScript para el contador de nombreUsuario -->
                <script>
                    const nombreUsuarioInput = document.getElementById('nombreUsuario');
                    const usernameCounter = document.getElementById('usernameCounter');

                    nombreUsuarioInput.addEventListener('input', function() {
                        const remaining = 12 - nombreUsuarioInput.value.length;
                        usernameCounter.textContent = `${remaining} caracteres restantes`;
                    });
                </script>

                <div class="input-container">
                    <i class="fa fa-envelope"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="50" value="{{ old('email') }}" placeholder="Ingresa correo electrónico" required>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="input-container">
                    <i class="fa fa-lock"></i>
                    <input id="password" type="password" name="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" minlength="8" maxlength="8" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8}">
                    <i class="fa fa-eye" id="togglePassword"></i>
                </div>
                <small class="form-text text-muted texto-pequeño">Debe contener exactamente 8 caracteres, incluyendo mayúsculas, minúsculas y números.</small>


                <div class="input-container">
                    <i class="fa fa-lock"></i>
                    <input id="password-confirm" class="form-control" type="password" name="password_confirmation" minlength="8" maxlength="8" placeholder="Confirmar contraseña" required>
                    <i class="fa fa-eye" id="togglePasswordConfirm"></i>
                </div>

                <div class="input-container">
                    <div class="radio-group" style="display: flex; justify-content: center; gap: 10px; text-align: center;">
                        <label>
                            <input type="radio" name="tipoUsuario" value="Estudiante" {{ old('tipoUsuario') == 'estudiante' ? 'checked' : '' }}> Estudiante
                        </label>
                        <label>
                            <input type="radio" name="tipoUsuario" value="Docente" {{ old('tipoUsuario') == 'docente' ? 'checked' : '' }}> Docente
                        </label>
                        <label>
                            <input type="radio" name="tipoUsuario" value="Director" {{ old('tipoUsuario') == 'director' ? 'checked' : '' }}> Director
                        </label>
                    </div>

                </div>
                @if ($errors->has('tipoUsuario'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tipoUsuario') }}</strong>
                </span>
                @endif

                <button type="submit" class="login-button">REGISTRARSE</button>
            </form>
        </div>
    </div>

</body>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password'); // Asegúrate de que este ID coincide con el input

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirmInput = document.getElementById('password-confirm');

    togglePasswordConfirm.addEventListener('click', function() {
        const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    // Validación de las contraseñas al enviar el formulario
    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', function(event) {
        if (!validatePasswords()) {
            event.preventDefault(); // Evita el envío del formulario si hay un error
            Swal.fire({
                text: "Las contraseñas no coinciden o no cumplen con los requisitos.",
                icon: "warning",
                confirmButtonText: "Aceptar",
                confirmButtonColor: '#006aff'
            });
        }
    });


    const validatePasswords = () => {
        const passwordMatch = passwordInput.value === passwordConfirmInput.value;
        const passwordValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/.test(passwordInput.value);
        return passwordMatch && passwordValid;
    };
    // Controlar el evento de envío
    registerForm.addEventListener('submit', function(event) {
        if (!validatePasswords()) {
            event.preventDefault(); // Evita el envío del formulario si hay un error
        }
    });
</script>

</html>