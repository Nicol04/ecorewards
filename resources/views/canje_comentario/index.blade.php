{{-- resources/views/canje_comentario/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comentarios de Canjes</h1>

    <form method="GET" action="{{ route('canjecomentario.index') }}" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="idcanje" class="col-form-label">Canje</label>
            </div>
            <div class="col-auto">
                <select name="idcanje" id="idcanje" class="form-select">
                    <option value="">Seleccione un canje</option>
                    @foreach ($canjes as $canje)
                        <option value="{{ $canje->idCanje }}" {{ request('idcanje') == $canje->idCanje ? 'selected' : '' }}>
                            {{ $canje->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <label for="comentario" class="col-form-label">Comentario</label>
            </div>
            <div class="col-auto">
                <input type="text" name="comentario" id="comentario" class="form-control" value="{{ request('comentario') }}">
            </div>

            <div class="col-auto">
                <label for="puntuacionMin" class="col-form-label">Puntuación Mínima</label>
            </div>
            <div class="col-auto">
                <input type="number" name="puntuacionMin" id="puntuacionMin" class="form-control" value="{{ request('puntuacionMin') }}">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <div class="col-auto mb-3">
        <a href="{{ route('canjecomentario.create') }}" class="btn btn-info btn-sm">Nuevo comentario</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Canje</th>
                <th>Foto</th>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Puntuación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comentarios as $comentario)
                <tr>
                    <td>{{ $comentario->idComentario }}</td>
                    <td>{{ $comentario->canje->nombre ?? 'Sin canje' }}</td>
                    <td>
                        @if($comentario->fotoObjeto)
                            <img src="{{ asset('storage/' . $comentario->fotoObjeto) }}" alt="Foto" class="img-thumbnail" style="width: 100px;">
                        @else
                            Sin foto
                        @endif
                    </td>
                    <td>{{ $comentario->comentario }}</td>
                    <td>{{ $comentario->fechaComentario->format('d/m/Y') }}</td>
                    <td>{{ $comentario->puntuacion }}</td>
                    <td>
                        <a href="{{ route('canjecomentario.show', $comentario) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('canjecomentario.edit', $comentario) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('canjecomentario.destroy', $comentario) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
