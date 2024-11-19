<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/style/style_login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Para los íconos -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-container">
        <div class="container">
        @if ( ($message = Session::get('mensaje')) && ($icono = Session::get('icono')) )
            <script>
                Swal.fire({
                    title: "Mensaje",
                    text: "{{$message}}",
                    icon: "{{$icono}}"
                });
            </script>
            @endif
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="max-width: 80%; height: auto; margin-bottom: 20px;">
            <h2>Inicia sesión y empieza a ganar</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-container">
                    <i class="fa fa-user"></i> <!-- Ícono de usuario -->
                    <input type="text" name="nombreUsuario" id="nombreUsuario" maxlength="12" placeholder="Nombre de usuario" value="{{ old('nombreUsuario') }}" required autofocus>
                </div>
                <div class="input-container">
                    <i class="fa fa-lock"></i> <!-- Ícono de candado para la contraseña -->
                    <input type="password" name="password" id="password" maxlength="8" placeholder="Contraseña" required>
                    <i class="fa fa-eye" id="togglePassword"></i> <!-- Ícono del ojo -->
                </div>
                <div class="remember-me-container">
                    <input type="checkbox" name="remember" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember-me">Recuérdame</label>
                </div>
                <button type="submit" class="login-button">LOGIN</button>
                <p><a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a></p>
                
            </form>

            <p class="footer">¿Aún no estás registrado? <a href="#">Crea una cuenta</a></p>
        </div>

        <div class="motivational-container">
            <div class="motivational-content">
                <img src="{{ asset('assets/img/inicio.jpg') }}" alt="Reciclaje" class="motivational-image"> <!-- Clases aplicadas -->
                <p class="motivational-phrase">"Reciclar es el primer paso hacia un mundo mas limpio y verde."</p>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Cambia el tipo de la contraseña a texto o viceversa
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Cambia el ícono cuando se hace clic
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
