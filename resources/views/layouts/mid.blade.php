<!-- Barra Navegacion Inicio -->
<div class="main-content">

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
                        <a href="{{ route('hogar') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'hogar' ? 'active' : '' }}">Inicio</a>
                        <a href="{{ route('public.sobrenosotros') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'public.sobrenosotros' ? 'active' : '' }}">Sobre nosotros</a>
                        <a href="{{ route('public.comofunciona') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'public.comofunciona' ? 'active' : '' }}">Cómo funciona?</a>
                        <a href="{{ route('public.escuela') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'public.escuela' ? 'active' : '' }}">Escuela</a>
                        <a href="{{ route('public.contacto') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'public.contacto' ? 'active' : '' }}">Contacto</a>
                        <a href="{{ route('public.recompensas') }}" class="nav-item nav-link {{ Route::currentRouteName() == 'public.recompensas' ? 'active' : '' }} : asset('static/img/recompensas.png') }}">
                            <img src="{{ Route::currentRouteName() == 'public.recompensas' ? asset('static/img/recompensasVerde.png') : asset('static/img/recompensas.png') }}"
                                alt="Recompensas"
                                class="boton-imagen"
                                style="width: 40px; height: auto;">
                        </a>

                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Fin Barra Navegacion -->

<script>
    document.querySelector('.boton-imagen').addEventListener('mouseenter', function() {
        this.src = "{{ asset('static/img/recompensasVerde.png') }}";
    });

    document.querySelector('.boton-imagen').addEventListener('mouseleave', function() {
        this.src = "{{ asset('static/img/recompensas.png') }}";
    });
</script>