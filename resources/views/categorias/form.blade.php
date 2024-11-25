@csrf

<div class="mb-3">
    <label for="nombreCategoria" class="form-label">Nombre de la Categoría</label>
    <input 
        type="text" 
        name="nombreCategoria" 
        id="nombreCategoria" 
        class="form-control @error('nombreCategoria') is-invalid @enderror" 
        value="{{ old('nombreCategoria', $categoria->nombreCategoria ?? '') }}" 
        required
    >
    @error('nombreCategoria')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea 
        name="descripcion" 
        id="descripcion" 
        class="form-control @error('descripcion') is-invalid @enderror"
        rows="4"
    >{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
