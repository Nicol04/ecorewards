@csrf

<div class="mb-3">
    <label for="nombreEscuela" class="form-label">Nombre de la Escuela</label>
    <input 
        type="text" 
        name="nombreEscuela" 
        id="nombreEscuela" 
        class="form-control @error('nombreEscuela') is-invalid @enderror" 
        value="{{ old('nombreEscuela', $escuela->nombreEscuela ?? '') }}" 
        required
    >
    @error('nombreEscuela')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="direccion" class="form-label">Dirección</label>
    <input 
        type="text" 
        name="direccion" 
        id="direccion" 
        class="form-control @error('direccion') is-invalid @enderror" 
        value="{{ old('direccion', $escuela->direccion ?? '') }}"
    >
    @error('direccion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input 
        type="text" 
        name="telefono" 
        id="telefono" 
        class="form-control @error('telefono') is-invalid @enderror" 
        value="{{ old('telefono', $escuela->telefono ?? '') }}"
    >
    @error('telefono')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="director" class="form-label">Director</label>
    <input 
        type="text" 
        name="director" 
        id="director" 
        class="form-control @error('director') is-invalid @enderror" 
        value="{{ old('director', $escuela->director ?? '') }}"
    >
    @error('director')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="logoEscuela" class="form-label">Logo de la Escuela</label>
    <input 
        type="file" 
        name="logoEscuela" 
        id="logoEscuela" 
        class="form-control @error('logoEscuela') is-invalid @enderror"
    >
    @if(isset($escuela) && $escuela->logoEscuela)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $escuela->logoEscuela) }}" alt="Logo actual" style="max-width: 150px;">
        </div>
    @endif
    @error('logoEscuela')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
