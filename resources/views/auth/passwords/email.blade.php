<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/style/email.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="login-container">
    <div class="content-container">
        <!-- Imagen con logo -->
        <div class="image-side">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo-image">
            <div class="motivational-container">
                <img src="{{ asset('assets/img/contraseña.png') }}" alt="Reciclaje" class="motivational-image">
            </div>
        </div>

        <!-- Formulario -->
        <div class="form-side">
            <!-- Icono centrado de pregunta -->
            <div class="icon-container">
                <i class="fas fa-question-circle"></i>
            </div>

            <!-- Título y mensaje de recuperación de contraseña -->
            <h1>¿Olvidó su Contraseña?</h1>
            <p>No hay problema. Simplemente déjenos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña.</p>

            <!-- Mensaje de éxito o error -->
            <div id="status-message" data-status="{{ session('status') }}"></div>
            <div id="error-message" data-error="{{ $errors->first('email') }}"></div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Campo de email -->
                <div class="input-container">
                    <div class="email-icon-container">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Correo electrónico" autofocus>

                    <!-- Mensajes de error -->
                    @error('email')
                    <span class="invalid-feedback" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="login-button">Enviar</button>
            </form>

            <!-- Botón "Ir a Iniciar Sesión" -->
            <a href="{{ url('/login') }}" class="brand-link">
                <button class="inicio-sesion-button">Ir a Iniciar Sesión</button>
            </a>
        </div>
    </div>
</div>



<script>
    // Verifica si hay un mensaje de éxito
    let successMessage = document.getElementById('status-message').getAttribute('data-status');
    if (successMessage) {
        // Si existe el mensaje de éxito, muestra el SweetAlert
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: successMessage,
        });
    }

    // Verifica si hay un mensaje de error
    let errorMessage = document.getElementById('error-message').getAttribute('data-error');
    if (errorMessage) {
        // Si hay error, muestra el SweetAlert con el mensaje
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: errorMessage,
        });
    }
</script>

</body>
</html>
