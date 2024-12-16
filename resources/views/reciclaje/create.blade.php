@extends('layouts.app')

@section('title', 'Registrar Reciclaje')

@section('content')

    <script src="https://unpkg.com/qr-scanner/qr-scanner.min.js"></script>

    <div class="container py-5">
        <h1 class="text-center mb-4">Registrar Reciclaje</h1>

        <form action="{{ route('reciclaje.store') }}" method="POST" id="formReciclaje">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">

                    <!-- Usuario -->
                    <div class="mb-4">
                        <label for="idusuario" class="form-label">Usuario</label>
                        <div class="input-group">
                            <input name="idusuario" id="idusuario" class="form-control form-control-lg shadow-sm"
                                value="{{ old('idusuario') }}" type="number" placeholder="Selecciona o escanea un código QR">
                            <button type="button" class="btn btn-secondary" id="scanQrButton" data-bs-toggle="tooltip"
                                title="Escanear QR">
                                <i class="bi bi-qr-code-scan"></i>
                            </button>
                        </div>
                        @error('idusuario')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Material -->
                    <div class="mb-4">
                        <label for="idmaterial" class="form-label">Material</label>
                        <select name="idmaterial" id="idmaterial" class="form-select form-control-lg shadow-sm">
                            <option value="">Seleccione un material</option>
                            @foreach ($materiales as $material)
                                <option value="{{ $material->idMaterial }}"
                                    {{ old('idmaterial') == $material->idMaterial ? 'selected' : '' }}>
                                    {{ $material->nombreMaterial }}</option>
                            @endforeach
                        </select>
                        @error('idmaterial')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fecha de Reciclaje -->
                    <div class="mb-4">
                        <label for="fechaReciclaje" class="form-label">Fecha de Reciclaje</label>
                        <input type="date" name="fechaReciclaje" id="fechaReciclaje"
                            class="form-control form-control-lg shadow-sm" value="{{ old('fechaReciclaje') }}">
                        @error('fechaReciclaje')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Cantidad -->
                    <div class="mb-4">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control form-control-lg shadow-sm"
                            value="{{ old('cantidad') }}" min="1">
                        @error('cantidad')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Puntos Obtenidos -->
                    <div class="mb-4">
                        <label for="puntosObtenidos" class="form-label">Puntos Obtenidos</label>
                        <input type="number" name="puntosObtenidos" id="puntosObtenidos"
                            class="form-control form-control-lg shadow-sm" value="{{ old('puntosObtenidos') }}">
                        @error('puntosObtenidos')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Vista de la Cámara -->
                    <div class="mb-4">
                        <label class="form-label">Vista de la Cámara</label>
                        <div class="camera-container mb-2">
                            <video id="camera-feed" autoplay muted class="w-100 border border-secondary rounded"></video>
                        </div>
                        <button type="button" class="btn btn-primary" id="start-camera">Iniciar Cámara</button>
                        <button type="button" class="btn btn-secondary" id="stop-camera" disabled>Detener Cámara</button>
                    </div>

                    <!-- Botón de Enviar -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">Registrar Reciclaje</button>
                    </div>

                </div>
            </div>
        </form>

    </div>

    <script>
        // Establecer automáticamente la fecha de reciclaje a la fecha actual
        document.getElementById('fechaReciclaje').value = new Date().toISOString().split('T')[0];

        // Control de la Cámara
        const videoElement = document.getElementById('camera-feed');
        const startButton = document.getElementById('start-camera');
        const stopButton = document.getElementById('stop-camera');
        let stream;
        let qrScanner;

        // Iniciar cámara
        startButton.addEventListener('click', async () => {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true });
                videoElement.srcObject = stream;
                videoElement.play();
                startQrScanner(); // Comenzar escaneo QR al iniciar la cámara
                startButton.disabled = true; // Deshabilitar botón de iniciar cámara
                stopButton.disabled = false; // Habilitar botón para detener la cámara
            } catch (error) {
                console.error('No se pudo acceder a la cámara:', error);
                alert('Error al acceder a la cámara. Verifique los permisos.');
            }
        });

        // Detener cámara
        stopButton.addEventListener('click', () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                videoElement.srcObject = null;
            }
            startButton.disabled = false; // Habilitar nuevamente el botón de iniciar cámara
            stopButton.disabled = true;  // Deshabilitar el botón de detener
            qrScanner.stop(); // Detener el escáner QR
        });

        // Inicialización del escáner QR
        async function startQrScanner() {
            try {
                qrScanner = new QrScanner(videoElement, (result) => {
                    document.getElementById('idusuario').value = result.data;  // Asignar el valor escaneado al campo usuario
                    stopCamera();  // Detener la cámara después de escanear el QR
                });
                await qrScanner.start(); // Asegurarse de que el escáner se inicie correctamente
            } catch (error) {
                console.error('Error al iniciar el escáner QR:', error);
                alert('No se pudo iniciar el escáner QR. Asegúrese de que la cámara está funcionando correctamente.');
            }
        }

        // Detener cámara
        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                videoElement.srcObject = null;
            }
            startButton.disabled = false;
            stopButton.disabled = true;
        }

        // Tooltip de QR
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

    <style>
        .camera-container {
            position: relative;
            height: auto;
            max-height: 300px;
            overflow: hidden;
        }
        #camera-feed {
            width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
    </style>

@endsection
