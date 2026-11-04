@extends('layouts.app')

@section('title', 'Editar Publicación - SegundaOportunidAPP')

@section('body-class', 'pagina-editar-publicacion')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/editar-publicacion.css') }}">
@endpush

@section('content')
<div class="edicion-contenedor">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card card-formulario edicion-tarjeta">
                <div class="card-body p-4">
                    <header class="edicion-encabezado">
                        <a href="{{ route('publicaciones.index') }}" class="edicion-volver">← Volver al catálogo</a>
                        <h1>Editar publicación</h1>
                        <p class="texto-secundario">Actualiza los datos de tu artículo para darle una segunda oportunidad.</p>
                    </header>
                    <h2 class="edicion-subtitulo">Datos del artículo</h2>
                    <p class="texto-secundario edicion-ayuda">Los campos marcados con * son obligatorios.</p>
                    <form action="{{ route('publicaciones.update', $publicacion['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título del artículo *</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $publicacion['titulo'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <textarea name="descripcion" id="descripcion" rows="4" class="form-control" required>{{ $publicacion['descripcion'] }}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo" class="form-label">Tipo de publicación *</label>
                                <select name="tipo" id="tipo" class="form-select" required>
                                    <option value="Donacion" {{ $publicacion['tipo'] == 'Donacion' ? 'selected' : '' }}>Donación</option>
                                    <option value="Venta" {{ $publicacion['tipo'] == 'Venta' ? 'selected' : '' }}>Venta</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="precio" class="form-label">Precio ($ MXN)</label>
                                <input type="number" step="0.01" min="0" aria-describedby="precio-ayuda" name="precio" id="precio" class="form-control" value="{{ $publicacion['precio'] }}">
                                <p id="precio-ayuda" class="texto-secundario edicion-nota">Para donaciones, indica $0.00.</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="estado_articulo" class="form-label">Estado del artículo *</label>
                            <select name="estado_articulo" id="estado_articulo" class="form-select" required>
                                <option value="Nuevo" {{ $publicacion['estado_articulo'] == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                                <option value="Como nuevo" {{ $publicacion['estado_articulo'] == 'Como nuevo' ? 'selected' : '' }}>Como nuevo</option>
                                <option value="Bueno" {{ $publicacion['estado_articulo'] == 'Bueno' ? 'selected' : '' }}>Bueno</option>
                                <option value="Usado" {{ $publicacion['estado_articulo'] == 'Usado' ? 'selected' : '' }}>Usado</option>
                            </select>
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
