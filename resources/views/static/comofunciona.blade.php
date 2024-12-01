
@extends('layouts.app')
@section('content')
    <div>
        <!-- Header Start -->
        <div class="container-fluid page-header">
            <div class="container">
                <div
                    class="d-flex flex-column align-items-center justify-content-center"
                    style="min-height: 400px">
                    <h3
                        class="display-4 text-white text-uppercase">¿Cómo funciona?</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-uppercase"><a class="text-white"
                                href="{{ route('hogar') }}">Inicio</a></p>
                        <i class="fa fa-angle-double-right pt-1 px-3"></i>
                        <p class="m-0 text-uppercase">¿Cómo funciona?</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->

        <!-- Contacto Inicio -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <class="text-center mb-3 pb-3">
                    <h6 class="text-primary text-uppercase"
                        style="letter-spacing: 5px;">¿Cómo funciona?</h6>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <!-- Sección de Pasos para Reciclar y Ganar Recompensas -->
                        <section id="pasos" class="steps-section">
                            <div class="container">
                                <h2 class="section-title">Cómo Reciclar y Gana
                                    Recompensas</h2>
                                <div class="steps-container">
                                    <div class="step">
                                        <div class="step-icon">
                                            <!-- SVG Icon para Paso 1 -->
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 64 64"
                                                class="animated-svg">
                                                <circle cx="32" cy="32" r="30"
                                                    stroke="#2e7d32"
                                                    stroke-width="4"
                                                    fill="none" />
                                                <path d="M20 32 L28 40 L44 24"
                                                    stroke="#2e7d32"
                                                    stroke-width="4" fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <h3 class="step-title">1.
                                            Regístrate</h3>
                                        <p class="step-description">Crea tu
                                            cuenta en nuestro sistema de
                                            reciclaje de manera fácil y
                                            rápida.</p>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon">
                                            <!-- SVG Icon para Paso 2 -->
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 64 64"
                                                class="animated-svg">
                                                <circle cx="32" cy="32" r="30"
                                                    stroke="#2e7d32"
                                                    stroke-width="4"
                                                    fill="none" />
                                                <path d="M20 24 L44 24 L32 48 Z"
                                                    stroke="#2e7d32"
                                                    stroke-width="4" fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <h3 class="step-title">2. Recicla tus
                                            Materiales</h3>
                                        <p class="step-description">Separa y
                                            deposita tus materiales reciclables
                                            en los puntos habilitados.</p>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon">
                                            <!-- SVG Icon para Paso 3 -->
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 64 64"
                                                class="animated-svg">
                                                <circle cx="32" cy="32" r="30"
                                                    stroke="#2e7d32"
                                                    stroke-width="4"
                                                    fill="none" />
                                                <path d="M20 32 L32 44 L44 32"
                                                    stroke="#2e7d32"
                                                    stroke-width="4" fill="none"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <h3 class="step-title">3. Gana
                                            Recompensas</h3>
                                        <p class="step-description">Acumula
                                            puntos por cada acción de reciclaje
                                            y canjéalos por recompensas.</p>
                                    </div>
                                </div>
                                <div class="steps-background"></div>
                            </div>
                        </section>
                        <video class="video-custom" controls>
                            <source src="img/ecorewards.mp4"  type="video/mp4">
                            Tu navegador no soporta la reproducción de videos.
                          </video>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contacto Fin -->


    </div>
    @endsection