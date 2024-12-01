{{-- resources/views/recompensas/create.blade.php --}}
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

    <h1>Crear Recompensa</h1>

    <form action="{{ route('recompensas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('recompensas.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
