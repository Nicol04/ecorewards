@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categorías</h1>

    <form method="GET" action="{{ route('categorias.index') }}">
        <div class="mb-3">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Buscar por nombre o descripción"
                value="{{ request('search') }}"
            >
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    
    <a href="{{ route('categorias.create') }}" type="submit" class="btn btn-primary">Nueva categoria</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nombreCategoria }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>
                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
