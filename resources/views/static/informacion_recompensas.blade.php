@extends('layouts.app')
@section('content')
<div class="d-flex">

    <!-- Panel lateral -->
    <div class="sidebar d-flex flex-column justify-content-center align-items-center">
        <!-- Opción: Configuración -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Configuración">
            <a href="{{ route('public.perfil') }}"><i class="fa fa-cog" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Configuración</span>
        </div>
        <!-- Opción: Canjes -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Canjes">
            <a href="{{ route('public.canjes') }}"><i class="fa fa-exchange-alt" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Canjes</span>
        </div>
        <!-- Opción: Puntos -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Puntos">
            <a href="{{ route('public.puntos') }}"><i class="fa fa-star" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Puntos</span>
        </div>
        <!-- Opción: Recompensas -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Recompensas">
            <a href="{{ route('public.historial_canjes') }}"><i class="fa fa-gift" style="color: #ffffff; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Recompensas</span>
        </div>
        <!-- Opción: Reciclaje -->
        <div class="sidebar-item d-flex flex-column align-items-center text-white py-3 px-2" style="cursor: pointer;" title="Reciclaje">
            <a href="{{ route('public.reciclaje') }}"><i class="fa fa-recycle" style="color: #7ab730; font-size: 1.5rem; transition: transform 0.3s;"></i></a>
            <span class="sidebar-text mt-2">Reciclaje</span>
        </div>
    </div>

    <!-- Inicio de informacion recompensas -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="pb-3">
                        <div class="blog-item">
                            <div class="position-relative">
                                <!-- Aquí puedes colocar la imagen de la recompensa -->
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$recompensa->imagen) }}" alt="Imagen de la recompensa">

                                <div class="blog-date">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary d-flex align-items-center">
                                        <i class="fa fa-arrow-left mr-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Detalles de la recompensa -->
                        <div class="bg-white mb-3" style="padding: 30px;">
                            <!-- Datos de la recompensa -->
                            <div class="d-flex mb-3">
                                <a class="text-primary text-uppercase text-decoration-none" href="#">{{ $recompensa->categorium->nombre }}</a>
                            </div>

                            <h2 class="mb-3">{{ $recompensa->nombreRecompensa }}</h2>
                            <p>{{ $recompensa->descripcion }}</p>
                            <p><strong>Puntos requeridos:</strong> {{ $recompensa->puntosRequeridos }}</p>
                            <p><strong>Stock disponible:</strong> {{ $recompensa->stock }}</p>

                            <!-- Mostrar el número de canjes -->
                            <p><strong>Cantidad canjes</strong> {{ $recompensa->canjes->count() }}</p>

                        </div>
                    </div>
                    <!-- Blog Detail End -->

                    <div class="bg-white" style="padding: 30px; margin-bottom: 30px;">
                        <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">
                            {{ $cantidadComentarios }} Comentarios
                        </h4>

                        @if($comentarios->count() > 0)
                        @foreach($comentarios as $canje_comentario)
                        <div class="media mb-4">
                            <!-- Imagen del usuario -->
                            <img src="{{ $canje_comentario->canje->usuario->persona->foto 
            ? Storage::url($canje_comentario->canje->usuario->persona->foto) 
            : asset('assets/img/usuario.png') }}"
                                alt="Imagen del Usuario"
                                class="img-fluid mr-3 rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover;">

                            <div class="media-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">
                                            <strong>
                                                {{ explode(' ', $canje_comentario->canje->usuario->persona->nombre ?? 'Anónimo')[0] }}
                                                {{ explode(' ', $canje_comentario->canje->usuario->persona->apellido ?? '')[0] }}
                                            </strong>
                                        </h6>
                                        <small class="text-muted"><i>{{ \Carbon\Carbon::parse($canje_comentario->fechaComentario)->format('d-m-Y') }}</i></small>
                                    </div>
                                    <!-- Puntuación -->
                                    <div class="d-flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <=$canje_comentario->puntuacion)
                                            <!-- Estrella llena -->
                                            <i class="fas fa-star" style="color: #FFD700;"></i>
                                            @else
                                            <!-- Estrella vacía -->
                                            <i class="fas fa-star" style="color: #CCCCCC;"></i>
                                            @endif
                                            @endfor
                                    </div>
                                </div>
                                <!-- Comentario -->
                                <p class="mt-2" style="text-align: justify;">{{ $canje_comentario->comentario }}</p>

                                <!-- Foto del objeto -->
                                @if($canje_comentario->fotoObjeto)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $canje_comentario->fotoObjeto) }}"
                                        alt="Foto del objeto"
                                        class="img-fluid"
                                        style="width: 250px; height: 250px; object-fit: cover;">
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $comentarios->links('pagination::bootstrap-4') }}
                        </div>
                        @else
                        <p>No hay comentarios para esta recompensa.</p>
                        @endif

                    </div>
                    <!-- Comment List End -->
                    <div class="media mb-4">
                        <!-- Imagen de perfil -->
                        <img src="{{ $usuario->persona && $usuario->persona->foto ? Storage::url($usuario->persona->foto) : asset('assets/img/usuario.png') }}"
                            alt="Imagen del Usuario"
                            class="img-fluid mr-3 mt-1"
                            style="width: 45px; border-radius: 50%;">

                        <!-- Contenedor para nombre, apellido y fecha -->
                        <div class="media-body">
                            <div class="d-flex justify-content-between mb-2">
                                <div class="text-left">
                                    <h6 class="mb-0">
                                        {{ $usuario->persona->nombre }} {{ $usuario->persona->apellido }}
                                    </h6>
                                    <!-- Tipo de Usuario alineado a la izquierda -->
                                    <small class="text-muted">{{ $usuario->tipoUsuario }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <!-- Fecha -->
                                    <p name="fechaComentario"><small class="text-muted ml-2"><i>{{ date('d M Y') }}</i></small></p>
                                    <!-- Estrellas para la puntuación -->
                                    <div class="stars" id="rating" data-rating="0" style="text-align: right; margin-left: 15px;">
                                        <i class="fa fa-star" data-value="1"></i>
                                        <i class="fa fa-star" data-value="2"></i>
                                        <i class="fa fa-star" data-value="3"></i>
                                        <i class="fa fa-star" data-value="4"></i>
                                        <i class="fa fa-star" data-value="5"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulario para agregar comentarios -->
                            <form action="{{ route('canje_comentario.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if($idcanje)
                                <input type="hidden" name="idcanje" value="{{ $idcanje }}">
                                <input type="hidden" name="fechaComentario" id="fechaComentario" value="{{ now()->format('Y-m-d') }}"> <!-- Campo oculto con la fecha -->
                                @else
                                <p class="text-danger">No has canjeado esta recompensa, no puedes comentar.</p>
                                @endif
                                <div class="form-group">
                                    <textarea name="comentario" class="form-control" rows="3" placeholder="Escribe tu comentario aquí..." {{ !$idcanje ? 'disabled' : '' }}></textarea>
                                    @if ($errors->has('comentario'))
                                    <span class="text-danger">{{ $errors->first('comentario') }}</span>
                                    @endif
                                </div>

                                <!-- Campo oculto para la puntuación -->
                                <input type="hidden" name="puntuacion" id="puntuacion" value="0">
                                @if ($errors->has('puntuacion'))
                                <span class="text-danger">{{ $errors->first('puntuacion') }}</span>
                                @endif

                                <!-- Subir imagen y botón para publicar -->
                                <div class="d-flex align-items-center">
                                    <label for="fotoObjeto" class="btn btn-sm btn-outline-primary mr-2" style="cursor: pointer;">
                                        <i class="fa fa-camera"></i> Subir imagen
                                    </label>
                                    <input type="file" id="fotoObjeto" name="fotoObjeto" accept="image/*" style="display: none;" {{ !$idcanje ? 'disabled' : '' }} onchange="previewImage(event)">
                                    @if ($errors->has('fotoObjeto'))
                                    <span class="text-danger">{{ $errors->first('fotoObjeto') }}</span>
                                    @endif
                                    <!-- Contenedor para previsualizar la imagen -->
                                    <div id="imagePreview" style="margin-top: 10px;">
                                        <img id="previewImg" src="" alt="Vista previa" style="max-width: 200px; display: none;" />
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary" {{ !$idcanje ? 'disabled' : '' }}>Publicar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <!-- Author Bio -->
                    <div class="d-flex flex-column text-center bg-white mb-5 py-5 px-4">
                        <h3 class="text-primary mb-3">{{ $recompensa->categorium->nombreCategoria }}</h3>
                        <p>{{ $recompensa->categorium->descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin recompensas info -->

        <!-- Boton de Canjear en caso que tenga -->
        <!-- Formulario de canje -->
<div class="d-flex justify-content-between align-items-center bg-white mt-4" style="padding: 30px;">
    <p><strong>Puntos disponibles:</strong> {{ $usuario->punto->puntosDisponibles }}</p>
    
    @if($usuario->punto->puntosDisponibles >= $recompensa->puntosRequeridos && $recompensa->stock > 0)
    <!-- Si el usuario tiene suficientes puntos y hay stock disponible -->
    <form action="{{ route('canjes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="recompensa_id" value="{{ $recompensa->idRecompensa }}">
        <input type="hidden" name="usuario_id" value="{{ $usuario->idUsuario }}">
        
        <button type="submit" class="btn btn-success">Canjear recompensa</button>
    </form>
    @else
    <!-- Si no tiene suficientes puntos o no hay stock -->
    <button class="btn btn-danger" disabled>No puedes canjear esta recompensa</button>
    @endif
</div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
    <style>
        .stars {
            display: flex;
            direction: row;
            justify-content: flex-end;
            /* Asegura que las estrellas estén alineadas a la derecha */
        }

        .stars i {
            font-size: 25px;
            color: #393939;
            /* color gris oscuro para el fondo */
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }

        .stars i.selected {
            color: #fbea08;
            /* color amarillo para las estrellas seleccionadas */
        }

        .stars i.hovered {
            color: #fbea08;
            /* color amarillo al pasar el mouse */
        }

        .sidebar {
            background-color: #212121;
            width: 100px;
            height: 100%;
            position: relative;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .sidebar:hover {
            width: 250px;
        }

        .sidebar-item:hover .sidebar-text {
            opacity: 1;
            visibility: visible;
        }

        .sidebar-text {
            opacity: 0;
            visibility: hidden;
            font-size: 0.9rem;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .sidebar:hover .sidebar-text {
            opacity: 1;
            visibility: visible;
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .card-body {
            padding: 2rem;
        }
    </style>
    <script>
        function previewImage(event) {
            var file = event.target.files[0]; // Obtener el archivo seleccionado
            var reader = new FileReader(); // Crear un objeto FileReader para leer el archivo

            reader.onload = function() {
                var previewImg = document.getElementById("previewImg"); // Obtener la imagen de vista previa
                previewImg.src = reader.result; // Asignar la imagen leída al src
                previewImg.style.display = "block"; // Mostrar la imagen
            }

            if (file) {
                reader.readAsDataURL(file); // Leer el archivo como una URL de datos
            }
        }
        const stars = document.querySelectorAll('.stars i');
        let rating = document.getElementById('rating');
        let puntuacionField = document.getElementById('puntuacion');

        // Reestablecer las estrellas a su estado inicial
        function resetStars() {
            stars.forEach(star => {
                star.classList.remove('hovered');
                star.classList.remove('selected');
            });
        }

        // Manejar el evento de pasar el ratón sobre las estrellas
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                resetStars();
                let value = this.getAttribute('data-value');
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('hovered');
                }
            });

            star.addEventListener('mouseout', function() {
                resetStars();
                let currentRating = rating.getAttribute('data-rating');
                for (let i = 0; i < currentRating; i++) {
                    stars[i].classList.add('selected');
                }
            });

            // Manejar el evento de hacer clic en las estrellas
            star.addEventListener('click', function() {
                let value = this.getAttribute('data-value');
                // Actualizamos el atributo 'data-rating' y el campo oculto
                rating.setAttribute('data-rating', value);
                puntuacionField.value = value;
                resetStars();
                // Pintar las estrellas seleccionadas
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('selected');
                }
            });
        });

        // Inicializar el estado de las estrellas con la puntuación actual (si hay alguna guardada)
        document.addEventListener('DOMContentLoaded', function() {
            let initialRating = rating.getAttribute('data-rating');
            for (let i = 0; i < initialRating; i++) {
                stars[i].classList.add('selected');
            }
        });

        // Formatear la fecha al formato YYYY-MM-DD
        function getFormattedDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Asegura que el mes tenga dos dígitos
            const day = today.getDate().toString().padStart(2, '0'); // Asegura que el día tenga dos dígitos
            return `${year}-${month}-${day}`; // Devuelve la fecha en formato YYYY-MM-DD
        }

        // Coloca la fecha formateada en el campo oculto
        document.addEventListener('DOMContentLoaded', function() {
            const formattedDate = getFormattedDate(); // Llama a la función para obtener la fecha
            document.getElementById('fechaCanje').value = formattedDate; // Asigna la fecha al campo oculto
        });
    </script>
    @endsection