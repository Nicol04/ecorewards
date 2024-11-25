<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('mensaje') && session('icono'))
    <script>
        Swal.fire({
            title: "Mensaje",
            text: "{{ session('mensaje') }}",
            icon: "{{ session('icono') }}"
        });
    </script>
@endif


<div class="container" style="background-color: #f8f9fa; padding: 40px; border-radius: 8px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center" style="font-size: 1.5rem; font-weight: bold; background-color: #005500; color: white;">
                    {{ __('Restablecer Contraseña') }}
                </div>

                <div class="card-body d-flex align-items-center">
                    <!-- Imagen al lado del formulario -->
                    <div class="d-none d-md-block" style="width: 40%; margin-right: 20px;">
                        <img src="{{ asset('assets/img/reset.png') }}" alt="Restablecer Contraseña" class="img-fluid" style="border-radius: 8px;">
                    </div>

                    <!-- Formulario -->
                    <div style="width: 100%;">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group mb-3">
    <label for="email">{{ __('Correo Electrónico') }}</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="bi bi-envelope-fill" style="color: #04993b;"></i></span>
        </div>
        <input id="email" type="text" class="form-control" name="email" value="{{ $email ?? old('email') }}" placeholder="Correo electrónico" readonly>
    </div>
</div>


                            <!-- Campo para Contraseña con Mostrar/Ocultar -->
                            <div class="form-group mb-3">
                                <label for="password">{{ __('Contraseña') }}</label>
                                <div class="position-relative">
                                <i class="fa fa-lock" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #04993b;"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" minlength="8" maxlength="8" required
                                        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8}" placeholder="Contraseña"
                                        style="padding-left: 40px; padding-right: 40px;">
                                    <i class="fa fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #04993b;"></i>
                                </div>
                                <small class="form-text text-muted">Debe contener exactamente 8 caracteres, incluyendo mayúsculas, minúsculas y números.</small>
                            </div>

                            <!-- Campo para Confirmación de Contraseña con Mostrar/Ocultar -->
                            <div class="form-group mb-3">
                                <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                                <div class="position-relative">
                                <i class="fa fa-lock" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #04993b;"></i>
                                <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" minlength="8" maxlength="8"
                                        placeholder="Confirmar contraseña" required
                                        style="padding-left: 40px; padding-right: 40px;">
                                    <i class="fa fa-eye" id="togglePasswordConfirm"
                                        style="cursor: pointer; position: absolute; right: 10px; top: 12px; color: #04993b;"></i>
                                </div>
                            </div>

                            <!-- Botón para Restablecer Contraseña -->
                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn w-100" style="background-color: #f6d824; color: #000; font-weight: bold;">
                                        {{ __('Restablecer Contraseña') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para Mostrar/Ocultar Contraseña -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#password-confirm');
        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection