@extends('layouts.app')

@section('titulo', 'Nueva Publicación - SegundaOportunidAPP')

@section('contenido')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h2 class="titulo mb-4">Nueva Publicación</h2>
                        <p class="texto-secundario text-muted">Los campos marcados con * son obligatorios.</p>

                        <form action="{{ route('publicaciones.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-bold">Título del artículo *</label>
                                <input type="text" name="titulo" id="titulo"
                                    class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}"
                                    placeholder="Ej. Chamarra de mezclilla">
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label fw-bold">Descripción *</label>
                                <textarea name="descripcion" id="descripcion" rows="3"
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    placeholder="Detalla el estado y características del artículo">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipo" class="form-label fw-bold">Tipo de publicación *</label>
                                    <select name="tipo" id="tipo"
                                        class="form-select @error('tipo') is-invalid @enderror">
                                        <option value="Donacion" {{ old('tipo') == 'Donacion' ? 'selected' : '' }}>Donación
                                        </option>
                                        <option value="Venta" {{ old('tipo') == 'Venta' ? 'selected' : '' }}>Venta</option>
                                    </select>
                                    @error('tipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="precio" class="form-label fw-bold">Precio ($ MXN)</label>
                                    <input type="number" step="0.01" min="0" name="precio" id="precio"
                                        class="form-control @error('precio') is-invalid @enderror"
                                        value="{{ old('precio', 0) }}" placeholder="0.00 para donaciones">
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label fw-bold">Categoría *</label>
                                <select name="categoria" id="categoria"
                                    class="form-select @error('categoria') is-invalid @enderror">
                                    <option value="" disabled {{ old('categoria') ? '' : 'selected' }}>Selecciona una
                                        categoría</option>
                                    @foreach (['Ropa', 'Electrónica', 'Hogar', 'Juguetes', 'Libros', 'Muebles', 'Otros'] as $cat)
                                        <option value="{{ $cat }}"
                                            {{ old('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('categoria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="estado_articulo" class="form-label fw-bold">Estado del artículo *</label>
                                <select name="estado_articulo" id="estado_articulo"
                                    class="form-select @error('estado_articulo') is-invalid @enderror">
                                    @foreach (['Nuevo', 'Como nuevo', 'Bueno', 'Usado'] as $estado)
                                        <option value="{{ $estado }}"
                                            {{ old('estado_articulo') == $estado ? 'selected' : '' }}>{{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('estado_articulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="foto" class="form-label fw-bold">Foto del artículo *</label>
                                <input type="file" name="foto" id="foto" accept="image/*"
                                    class="form-control @error('foto') is-invalid @enderror">
                                <div class="form-text">Formatos JPG, PNG o WEBP. Máximo 2 MB.</div>
                                @error('foto')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('publicaciones.index') }}"
                                    class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">Guardar
                                    Publicación</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
