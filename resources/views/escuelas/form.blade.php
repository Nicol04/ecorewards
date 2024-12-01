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
    <label for="direccionLink" class="form-label">Enlace de Google Maps</label>
    <input 
        type="url" 
        name="direccionLink" 
        id="direccionLink" 
        class="form-control @error('direccionLink') is-invalid @enderror" 
        value="{{ old('direccionLink', $escuela->direccionLink ?? '') }}"
    >
    @error('direccionLink')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="direccionUrl" class="form-label">Enlace de Google Maps (Iframe)</label>
    <input 
        type="text" 
        name="direccionUrl" 
        id="direccionUrl" 
        class="form-control @error('direccionUrl') is-invalid @enderror" 
        value="{{ old('direccionUrl', $escuela->direccionUrl ?? '') }}"
        placeholder="Introduce el enlace del iframe de Google Maps"
    >
    @error('direccionUrl')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <button type="button" id="loadMap" class="btn btn-primary">Cargar Vista Previa del Mapa</button>
</div>

<div class="mb-3" id="mapContainer" style="display: none;">
    <label for="mapPreview" class="form-label">Vista Previa del Mapa</label>
    <iframe id="mapFrame" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>

<script>
    document.getElementById('loadMap').addEventListener('click', function () {
        const mapUrl = document.getElementById('direccionUrl').value;
        const mapFrame = document.getElementById('mapFrame');
        const mapContainer = document.getElementById('mapContainer');

        if (mapUrl) {
            mapFrame.src = mapUrl;
            mapContainer.style.display = 'block';
        } else {
            alert('Por favor, introduce un enlace válido del iframe de Google Maps.');
        }
    });
</script>

<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input 
        type="text" 
        name="telefono" 
        id="telefono" 
        class="form-control @error('telefono') is-invalid @enderror" 
        value="{{ old('telefono', $escuela->telefono ?? '') }}"
        pattern="[0-9]{9}"   
        maxlength="9"      
        oninput="this.value=this.value.replace(/[^0-9]/g,'');" 
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
