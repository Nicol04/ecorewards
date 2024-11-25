<!-- Barra Navegacion Inicio -->
<div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="{{ url('/login') }}" class="brand-link">
                    <img src="{{ asset('assets/img/logo.png') }}" style="width: 150px; height: auto;">
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="" class="nav-item nav-link active">Inicio</a>
                        <a href="" class="nav-item nav-link">Sobre nosotros</a>
                        <a href="" class="nav-item nav-link">Cómo funciona?</a>
                        <a href="" class="nav-item nav-link">Escuela</a>
                        <a href="" class="nav-item nav-link" >Contacto</a>
                        <a href="{{ route('recompensas.index') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'recompensas.index' ? 'active' : '' }}">
                            <img src="{{ asset('static/img/recompensas.png') }}" alt="Recompensas" class="boton-imagen"></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Fin Barra Navegacion -->