@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>
    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')
        @include('categorias.form') <!-- Incluimos el formulario -->
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
