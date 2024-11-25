@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Escuela</h1>
    <form action="{{ route('escuelas.store') }}" method="POST" enctype="multipart/form-data">
        @include('escuelas.form') <!-- Incluimos el formulario aquí -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
