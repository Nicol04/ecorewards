{{-- resources/views/recompensas/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Recompensa</h1>

    <form method="POST" action="{{ route('recompensas.store') }}">
        @csrf
        @include('recompensas.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
