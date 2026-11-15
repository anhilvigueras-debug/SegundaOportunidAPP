@extends('layouts.app')

@section('titulo', 'Editar Publicación - SegundaOportunidAPP')

@section('body-class', 'pagina-editar-publicacion')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/editar-publicacion.css') }}">
@endpush

@section('contenido')
    <div class="edicion-contenedor">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-formulario edicion-tarjeta">
                    <div class="card-body p-4">
                        <header class="edicion-encabezado">
                            <a href="{{ route('publicaciones.index') }}" class="edicion-volver">← Volver al catálogo</a>
                            <h1>Editar publicación</h1>
                            <p class="texto-secundario">Actualiza los datos de tu artículo para darle una segunda
                                oportunidad.</p>
                        </header>
                        <h2 class="edicion-subtitulo">Datos del artículo</h2>
                        <p class="texto-secundario edicion-ayuda">Los campos marcados con * son obligatorios.</p>

                        <form action="{{ route('publicaciones.update', $publicacion['id']) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del artículo *</label>
                                <input type="text" name="titulo" id="titulo"
                                    class="form-control @error('titulo') is-invalid @enderror"
                                    value="{{ old('titulo', $publicacion['titulo']) }}">
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción *</label>
                                <textarea name="descripcion" id="descripcion" rows="4"
                                    class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $publicacion['descripcion']) }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipo" class="form-label">Tipo de publicación *</label>
                                    <select name="tipo" id="tipo"
                                        class="form-select @error('tipo') is-invalid @enderror">
                                        <option value="Donacion"
                                            {{ old('tipo', $publicacion['tipo']) == 'Donacion' ? 'selected' : '' }}>Donación
                                        </option>
                                        <option value="Venta"
                                            {{ old('tipo', $publicacion['tipo']) == 'Venta' ? 'selected' : '' }}>Venta
                                        </option>
                                    </select>
                                    @error('tipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="precio" class="form-label">Precio ($ MXN)</label>
                                    <input type="number" step="0.01" min="0" aria-describedby="precio-ayuda"
                                        name="precio" id="precio"
                                        class="form-control @error('precio') is-invalid @enderror"
                                        value="{{ old('precio', $publicacion['precio']) }}">
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <p id="precio-ayuda" class="texto-secundario edicion-nota">Para donaciones, indica
                                        $0.00.</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría *</label>
                                <select name="categoria" id="categoria"
                                    class="form-select @error('categoria') is-invalid @enderror">
                                    @foreach (['Ropa', 'Electrónica', 'Hogar', 'Juguetes', 'Libros', 'Muebles', 'Otros'] as $cat)
                                        <option value="{{ $cat }}"
                                            {{ old('categoria', $publicacion['categoria'] ?? '') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('categoria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="estado_articulo" class="form-label">Estado del artículo *</label>
                                <select name="estado_articulo" id="estado_articulo"
                                    class="form-select @error('estado_articulo') is-invalid @enderror">
                                    @foreach (['Nuevo', 'Como nuevo', 'Bueno', 'Usado'] as $estado)
                                        <option value="{{ $estado }}"
                                            {{ old('estado_articulo', $publicacion['estado_articulo']) == $estado ? 'selected' : '' }}>
                                            {{ $estado }}</option>
                                    @endforeach
                                </select>
                                @error('estado_articulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="edicion-acciones">
                                <a href="{{ route('publicaciones.index') }}" class="btn edicion-cancelar">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar publicación</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
