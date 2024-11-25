<div class="container-fluid bg-light pt-3 d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <p><i class="fa fa-envelope mr-2"></i>ecorewards@gmail.com</p>
                    <p class="text-body px-3">|</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+51 924829851</p>
                </div>
            </div>
            
            <!-- Autenticación -->
            <div class="col-lg-6 text-right">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item d-inline-block">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item d-inline-block">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endif
                @else
                    @php
                        $usuario = Auth::user(); // Usuario autenticado
                        $imagenPerfil = $usuario->empleado && $usuario->empleado->foto 
                            ? Storage::url($usuario->empleado->foto) 
                            : asset('assets/img/usuario.png'); // Ruta de la imagen predeterminada
                    @endphp

                    <li class="nav-item dropdown d-inline-block">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $imagenPerfil }}" alt="Foto de {{ $usuario->name }}" class="user-avatar img-fluid mr-2">
                            {{ $usuario->nombreUsuario }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">Perfil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </div>
    </div>
</div>

<style>
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
