@extends('layouts.app')

@section('title', 'Lista de Reciclajes')

@section('content')
    <div class="container">
        <h1 class="my-4">Lista de Reciclajes</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('reciclaje.create') }}" class="btn btn-primary">Registrar Nuevo Canje</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Material</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Puntos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reciclajes as $reciclaje)
                    <tr>
                        <td>{{ $reciclaje->idReciclaje }}</td>
                        <td>{{ $reciclaje->usuario->nombreUsuario }}</td>
                        <td>{{ $reciclaje->material->nombreMaterial }}</td>
                        <td>{{ $reciclaje->fechaReciclaje }}</td>
                        <td>{{ $reciclaje->cantidad }}</td>
                        <td>{{ $reciclaje->puntosObtenidos }}</td>
                        <td>
                            <a href="{{ route('reciclaje.edit', $reciclaje) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('reciclaje.destroy', $reciclaje) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay registros de reciclaje</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $reciclajes->links() }}
        </div>
    </div>
@endsection
