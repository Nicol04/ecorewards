@extends('layouts.app')

@section('title', 'Editar Reciclaje')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Reciclaje</h1>

        <form action="{{ route('reciclaje.update', $reciclaje->idusuario) }}" method="POST">
            @csrf
            @method('PUT')

            
            <div class="mb-3">
                <label for="idReciclaje" class="form-label">ID Reciclaje</label>
                <input type="number" name="idReciclaje" id="idReciclaje" class="form-control" value="{{ $reciclaje->idReciclaje }}" readonly>
                @error('idReciclaje')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" value="{{ $reciclaje->usuario->nombreUsuario }}" readonly>
                @error('nombreUsuario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            

            <div class="mb-3">
                <label for="idusuario" class="form-label">Usuario</label>
                <input type="number" name="puntosObtenidos" id="puntosObtenidos" class="form-control" value="{{ $reciclaje->idusuario }}">
                @error('idusuario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="idmaterial" class="form-label">Material</label>
                <select name="idmaterial" id="idmaterial" class="form-select">
                    <option value="">Seleccione un material</option>
                    @foreach($materiales as $material)
                        <option value="{{ $material->idMaterial }}" {{ $reciclaje->idmaterial == $material->idMaterial ? 'selected' : '' }}>
                            {{ $material->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('idmaterial')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fechaReciclaje" class="form-label">Fecha de Reciclaje</label>
                <input type="date" name="fechaReciclaje" id="fechaReciclaje" class="form-control" 
                       value="{{ \Carbon\Carbon::parse($reciclaje->fechaReciclaje)->format('Y-m-d') }}">
                @error('fechaReciclaje')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $reciclaje->cantidad }}">
                @error('cantidad')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="puntosObtenidos" class="form-label">Puntos Obtenidos</label>
                <input type="number" name="puntosObtenidos" id="puntosObtenidos" class="form-control" value="{{ $reciclaje->puntosObtenidos }}">
                @error('puntosObtenidos')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
@endsection
