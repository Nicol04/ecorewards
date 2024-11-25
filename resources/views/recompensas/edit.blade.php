{{-- resources/views/recompensas/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Recompensa</h1>

    <form method="POST" action="{{ route('recompensas.update', $recompensa) }}">
        @csrf
        @method('PUT')
        @include('recompensas.form', ['recompensa' => $recompensa])
        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
</div>
@endsection