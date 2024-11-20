@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Categoría</h1>
    <form action="{{ route('categorias.store') }}" method="POST">
        @include('categorias.form') <!-- Incluimos el formulario -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
