@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Escuela</h1>
    <form action="{{ route('escuelas.update', $escuela) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('escuelas.form') <!-- Incluimos el formulario aquí -->
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
