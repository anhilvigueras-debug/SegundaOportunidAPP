@extends('layouts.app')

@section('title', 'Nueva Publicación - SegundaOportunidAPP')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h2 class="titulo mb-4">Nueva Publicación</h2>

                        <form action="{{ route('publicaciones.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-bold">Título del artículo</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" required
                                    placeholder="Ej. Chamarra de mezclilla">
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label fw-bold">Descripción</label>
                                <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required
                                    placeholder="Detalla el estado y características del artículo"></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tipo" class="form-label fw-bold">Tipo de publicación</label>
                                    <select name="tipo" id="tipo" class="form-select" required>
                                        <option value="Donacion">Donación</option>
                                        <option value="Venta">Venta</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="precio" class="form-label fw-bold">Precio ($ MXN)</label>
                                    <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                                        value="0" placeholder="0.00 para donaciones">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="estado_articulo" class="form-label fw-bold">Estado del artículo</label>
                                <select name="estado_articulo" id="estado_articulo" class="form-select" required>
                                    <option value="Nuevo">Nuevo</option>
                                    <option value="Como nuevo">Como nuevo</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Usado">Usado</option>
                                </select>
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
