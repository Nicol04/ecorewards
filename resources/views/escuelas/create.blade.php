@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>Crear Nueva Escuela</h1>
    <form action="{{ route('escuelas.store') }}" method="POST" enctype="multipart/form-data">
        @include('escuelas.form') <!-- Incluimos el formulario aquí -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
