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

                            @include('publicaciones._form')

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
