{{-- resources/views/recompensas/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Recompensas</h1>

    <form method="GET" action="{{ route('recompensas.index') }}" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="idcategoria" class="col-form-label">Categoría</label>
            </div>
            <div class="col-auto">
                <select name="idcategoria" id="idcategoria" class="form-select">
                    <option value="">Seleccione una categoría</option>
                    {{-- Suponiendo que tienes las categorías disponibles --}}
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->idcategoria }}" {{ request('idcategoria') == $categoria->idcategoria ? 'selected' : '' }}>{{ $categoria->nombreCategoria }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <label for="nombre" class="col-form-label">Nombre</label>
            </div>
            <div class="col-auto">
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}">
            </div>

            <div class="col-auto">
                <label for="puntosMin" class="col-form-label">Puntos Mínimos</label>
            </div>
            <div class="col-auto">
                <input type="number" name="puntosMin" id="puntosMin" class="form-control" value="{{ request('puntosMin') }}">
            </div>

            <div class="col-auto">
                <label for="puntosMax" class="col-form-label">Puntos Máximos</label>
            </div>
            <div class="col-auto">
                <input type="number" name="puntosMax" id="puntosMax" class="form-control" value="{{ request('puntosMax') }}">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>


    <div class="col-auto">
        <a href="{{ route('recompensas.create') }}" class="btn btn-info btn-sm">Nueva Recompensa</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Puntos Requeridos</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recompensas as $recompensa)
                <tr>
                    <td>{{ $recompensa->idRecompensa }}</td>
                    <td>{{ $recompensa->nombreRecompensa }}</td>
                    <td>{{ $recompensa->descripcion }}</td>
                    <td>{{ $recompensa->puntosRequeridos }}</td>
                    <td>{{ $recompensa->stock }}</td>
                    <td>{{ $recompensa->categorium->nombreCategoria ?? 'Sin categoría' }}</td>
                    <td>
                        <a href="{{ route('recompensas.show', $recompensa) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('recompensas.edit', $recompensa) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('recompensas.destroy', $recompensa) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta recompensa?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection