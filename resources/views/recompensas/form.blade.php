{{-- resources/views/recompensas/form.blade.php --}}
<div class="mb-3">
    <label for="nombreRecompensa" class="form-label">Nombre</label>
    <input type="text" name="nombreRecompensa" id="nombreRecompensa" class="form-control" value="{{ old('nombreRecompensa', $recompensa->nombreRecompensa ?? '') }}">
</div>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $recompensa->descripcion ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="puntosRequeridos" class="form-label">Puntos Requeridos</label>
    <input type="number" name="puntosRequeridos" id="puntosRequeridos" class="form-control" value="{{ old('puntosRequeridos', $recompensa->puntosRequeridos ?? '') }}">
</div>
<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $recompensa->stock ?? '') }}">
</div>
<div class="mb-3">
    <label for="imagen" class="form-label">Imagen</label>
    <input type="file" name="imagen" id="imagen" class="form-control">
    @if(!empty($recompensa->imagen))
        <p class="mt-2">Imagen actual:</p>
        <img src="{{ asset('storage/' . $recompensa->imagen) }}" alt="Imagen de recompensa" class="img-thumbnail" style="max-width: 150px;">
    @endif
</div>
<div class="mb-3">
    <label for="idCategoria" class="form-label">Categoría</label>
    <select name="idcategoria" id="idcategoria" class="form-select">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->idCategoria }}" {{ old('idCategoria', $recompensa->idCategoria ?? '') == $categoria->idCategoria ? 'selected' : '' }}>{{ $categoria->nombreCategoria }}</option>
        @endforeach
    </select>
</div>