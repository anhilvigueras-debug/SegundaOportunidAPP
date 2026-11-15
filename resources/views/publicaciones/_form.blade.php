@php
    $p = $publicacion ?? null;
    $categorias = ['Ropa', 'Electrónica', 'Hogar', 'Juguetes', 'Libros', 'Muebles', 'Otros'];
    $estados = ['Nuevo', 'Como nuevo', 'Bueno', 'Usado'];

    $tipoActual = old('tipo', $p->tipo ?? 'Donacion');
    $categoriaActual = old('categoria', $p->categoria ?? '');
    $estadoActual = old('estado_articulo', $p->estado_articulo ?? 'Nuevo');
@endphp

<div class="mb-3">
    <label for="titulo" class="form-label">Título del artículo *</label>
    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
        value="{{ old('titulo', $p->titulo ?? '') }}" placeholder="Ej. Chamarra de mezclilla">
    @error('titulo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción *</label>
    <textarea name="descripcion" id="descripcion" rows="4"
        class="form-control @error('descripcion') is-invalid @enderror"
        placeholder="Detalla el estado y características del artículo">{{ old('descripcion', $p->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label for="tipo" class="form-label">Tipo de publicación *</label>
        <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror">
            <option value="Donacion" {{ $tipoActual == 'Donacion' ? 'selected' : '' }}>Donación</option>
            <option value="Venta" {{ $tipoActual == 'Venta' ? 'selected' : '' }}>Venta</option>
        </select>
        @error('tipo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="precio" class="form-label">Precio ($ MXN)</label>
        <input type="number" step="0.01" min="0" name="precio" id="precio"
            aria-describedby="precio-ayuda" class="form-control @error('precio') is-invalid @enderror"
            value="{{ old('precio', $p->precio ?? 0) }}">
        @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <p id="precio-ayuda" class="texto-secundario edicion-nota">Para donaciones, indica $0.00.</p>
    </div>
</div>

<div class="mb-3">
    <label for="categoria" class="form-label">Categoría *</label>
    <select name="categoria" id="categoria" class="form-select @error('categoria') is-invalid @enderror">
        <option value="" disabled {{ $categoriaActual ? '' : 'selected' }}>Selecciona una categoría</option>
        @foreach ($categorias as $cat)
            <option value="{{ $cat }}" {{ $categoriaActual == $cat ? 'selected' : '' }}>{{ $cat }}
            </option>
        @endforeach
    </select>
    @error('categoria')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="estado_articulo" class="form-label">Estado del artículo *</label>
    <select name="estado_articulo" id="estado_articulo"
        class="form-select @error('estado_articulo') is-invalid @enderror">
        @foreach ($estados as $estado)
            <option value="{{ $estado }}" {{ $estadoActual == $estado ? 'selected' : '' }}>{{ $estado }}
            </option>
        @endforeach
    </select>
    @error('estado_articulo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<div class="mb-4">
    <label for="foto" class="form-label">Foto del artículo {{ $p ? '' : '*' }}</label>

    @if ($p && $p->foto)
        <div class="mb-2">
            <img src="{{ asset($p->foto) }}" alt="Foto actual de {{ $p->titulo }}" class="img-thumbnail"
                style="max-height: 160px;">
        </div>
    @endif

    <input type="file" name="foto" id="foto" accept="image/*"
        class="form-control @error('foto') is-invalid @enderror">
    <div class="form-text">
        {{ $p ? 'Déjalo vacío para conservar la foto actual. ' : '' }}Formatos JPG, PNG o WEBP. Máximo 2 MB.
    </div>
    @error('foto')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
