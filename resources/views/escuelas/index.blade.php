@extends('layouts.app')

@section('content')
<h1>Lista de Escuelas</h1>

<a href="{{ route('escuelas.create') }}">Crear Nueva Escuela</a>

<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Director</th>
            <th>Logo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($escuelas as $escuela)
        <tr>
            <td>{{ $escuela->nombreEscuela }}</td>
            <td>{{ $escuela->direccion }}</td>
            <td>{{ $escuela->telefono }}</td>
            <td>{{ $escuela->director }}</td>
            <td><img src="{{ asset('storage/' . $escuela->logoEscuela) }}" alt="Logo" width="50"></td>
            <td>
                <a href="{{ route('escuelas.show', $escuela) }}">Ver</a>
                <a href="{{ route('escuelas.edit', $escuela) }}">Editar</a>
                <form action="{{ route('escuelas.destroy', $escuela) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

