@extends('layouts.app')
@section('content')
<div>
    <!-- Inicio Arriba -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Sobre Nosotros</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('hogar') }}">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Sobre nosotros</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Inicio Fin -->

    <!-- Booking Inicio -->
    <div class="container-fluid booking mt-5 pb-5">
        <div class="container pb-5">
            <div class="bg-light shadow" style="padding: 30px;">
                <div style="text-align: center;">
                    <p >Somos un grupo de estudiantes del octavo ciclo de Ingeniería de Sistemas, comprometidos con la sostenibilidad y el medio ambiente. Nuestro objetivo es fomentar la cultura del reciclaje en las escuelas a través de un innovador sistema de recompensas. A través de nuestro proyecto, los estudiantes podrán acumular puntos por reciclar, que luego podrán canjear por premios, incentivando así un comportamiento responsable con el entorno. Este proyecto nació como parte de un curso académico, pero lo hemos convertido en una iniciativa que busca generar un impacto positivo en las futuras generaciones.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Fin -->

    <!-- Sobre nosotros inicio -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('static/img/sobrenosotros.png') }}" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Sobre nosotros</h6>
                        <h1 class="mb-3">Impulsemos el reciclaje juntos!!</h1>
                        <p>En nuestra plataforma innovadora, los estudiantes no solo aprenderán sobre el reciclaje, sino que serán recompensados por hacerlo. Este sistema motiva a los jóvenes a adoptar hábitos ecológicos de forma divertida y educativa, acumulando puntos por cada material reciclado que podrán canjear por increíbles recompensas.
                        </p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('static/img/sobrenosotros1.jpg') }}" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="{{ asset('static/img/sobrenosotros2.jpg') }}" alt="">
                            </div>
                        </div>
                        <a href="{{ route('public.contacto') }}" class="btn btn-primary mt-1">Contáctanos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sobre nosotros Fin -->


    <!-- Inicio Caracteristicas -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="min-height: 100px; min-width: 100px; height: auto; width: 100px;">
                            <img src="{{ asset('static/img/sobrenosotros3.png') }}" alt="Promovemos el reciclaje" style="max-height: 80px; max-width: 80px; object-fit: cover; margin: auto;">
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Promovemos el reciclaje</h5>
                            <p class="m-0">Motivamos a los estudiantes a reciclar y a participar activamente en la protección del medio ambiente.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="min-height: 100px; min-width: 100px; height: auto; width: 100px;">
                            <img src="{{ asset('static/img/sobrenosotros4.png') }}" alt="Recompensas atractivas" style="max-height: 80px; max-width: 80px; object-fit: cover; margin: auto;">
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Recompensas atractivas</h5>
                            <p class="m-0">Los estudiantes pueden acumular puntos al reciclar y canjearlos por premios, incentivando el compromiso ecológico.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="min-height: 100px; min-width: 100px; height: auto; width: 100px;">
                            <img src="{{ asset('static/img/sobrenosotros5.png') }}" alt="Educación para un futuro sostenible" style="max-height: 80px; max-width: 80px; object-fit: cover; margin: auto;">
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Educación para un futuro sostenible</h5>
                            <p class="m-0">Ayudamos a las escuelas a formar una nueva generación de ciudadanos responsables con el medio ambiente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Caracteristicas -->
        
    <!-- Inicio Equipo -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Nuestro equipo</h6>
                <h1>Conoce a nuestro equipo</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <!-- Miembro 1 -->
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('static/img/foto1.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary" href="">Apasionado por la tecnología y el medio ambiente, Gian fusiona su amor por el reciclaje y la programación para crear soluciones sostenibles.</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Gian Avalo</h5>
                        <p class="m-0">Innovador Ecológico</p>
                    </div>
                </div>
                <!-- Miembro 2 -->
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('static/img/foto2.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary" href="">Cada desafío es una oportunidad. Con su enfoque estratégico, impulsa al equipo a superar límites.</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Abdul Ramos</h5>
                        <p class="m-0">Estratega Verde</p>
                    </div>
                </div>
                <!-- Miembro 3 -->
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('static/img/foto4.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary" href="">Conecta a las personas con la causa ecológica. Su habilidad para transmitir mensajes motivadores hace que más estudiantes y escuelas se sumen a esta iniciativa.</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Farid Piscoya</h5>
                        <p class="m-0">(Líder de Proyecto) Comunicador Ambiental</p>
                    </div>
                </div>
                <!-- Miembro 4 -->
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('static/img/foto5.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary" href="">Convencido de que las pequeñas acciones generan grandes cambios, es el corazón del compromiso del equipo para educar a las futuras generaciones sobre la importancia del reciclaje.</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Pharis Girón</h5>
                        <p class="m-0">Defensor del Futuro</p>
                    </div>
                </div>
                <!-- Miembro 5 -->
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('static/img/foto6.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary" href="">Crea soluciones visuales y funcionales que educan, motivan y transforman la cultura del reciclaje en las escuelas, mostrando que el diseño también puede cambiar el mundo.</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Maura Velasquez</h5>
                        <p class="m-0">Diseñador del Cambio</p>
                    </div>
                </div>
                <!-- Miembro 6 -->
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('static/img/foto7.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary" href="">La creatividad es su mayor herramienta. Aplica las últimas tecnologías para facilitar el reciclaje en las escuelas, asegurando que cada proceso sea eficiente y emocionante para los estudiantes.</a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Katherin Fuentes</h5>
                        <p class="m-0">Innovador Tecnológico</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Equipo -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
    
</div>
@endsection