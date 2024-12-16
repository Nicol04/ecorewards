<div class="container-fluid bg-light pt-3 d-none d-lg-block topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <p><i class="fa fa-envelope mr-2"></i>ecorewards@gmail.com</p>
                    <p class="text-body px-3">|</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+51 924829851</p>
                </div>
            </div>

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
                        $usuario = Auth::user();
                        $imagenPerfil =
                            $usuario->empleado && $usuario->empleado->foto
                                ? Storage::url($usuario->empleado->foto)
                                : asset('assets/img/usuario.png');
                    @endphp

@if ($usuario->tipoUsuario === 'Administrador')
                        <!-- Corregido operador de comparación -->
                        <!-- Aquí es donde quieres mostrar las pestañas solo para administradores -->
                        <li class="nav-item dropdown d-inline-block">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $imagenPerfil }}" alt="Foto de {{ $usuario->name }}"
                                    class="user-avatar img-fluid mr-2">
                                {{ $usuario->nombreUsuario }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"><i class="bi bi-house-door-fill"></i> Dashboard</a>

                                <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i
                                        class="bi bi-person-fill"></i> Gestión de Usuarios</a>

                                <a class="dropdown-item" href="{{ route('reciclaje.index') }}"><i class="bi bi-star-fill"></i> Asignar Puntos</a>

                                <a class="dropdown-item" href="{{ route('recompensas.index') }}"><i class="fas fa-trophy"></i> Recompensas</a>
                                
                                <a class="dropdown-item" href="{{ route('categorias.index') }}"><i class="fas fa-th-list"></i> Categorías</a>
                                
                                <a class="dropdown-item" href="{{ route('materials.index') }}"><i class="fas fa-cogs"></i> Materiales</a>

                                <a class="dropdown-item" href="{{ route('escuelas.index') }}"><i class="fas fa-school"></i> Escuelas</a>


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                    
                    <li class="nav-item dropdown d-inline-block">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $imagenPerfil }}" alt="Foto de {{ $usuario->name }}"
                                class="user-avatar img-fluid mr-2">
                            {{ $usuario->nombreUsuario }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('public.perfil') }}"><i class="bi bi-person-fill"></i>
                                Perfil</a>
                            <a class="dropdown-item" href="{{ route('public.canjes') }}"><i class="fa fa-exchange-alt"></i>
                                Canjes</a>
                            <a class="dropdown-item" href="{{ route('public.puntos') }}"><i class="fa fa-star"></i>
                                Puntos</a>
                            <a class="dropdown-item" href="{{ route('public.reciclaje') }}"><i class="fa fa-recycle"></i>
                                Reciclaje</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    
                    @endif
                @endguest
            </div>
        </div>
    </div>
</div>


<style>
    /* Barra superior */
    /* Barra superior */
    .topbar {
        position: absolute;
        /* Se sobrepone al contenido */
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1050;
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 80px;
        /* Asegúrate de definir una altura fija */
    }

    /* Avatar de usuario */
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Ajustar el contenido principal */
    .main-content {
        margin-top: 80px;
        /* Ajusta este valor al mismo que el de la altura de .topbar */
    }
</style>
