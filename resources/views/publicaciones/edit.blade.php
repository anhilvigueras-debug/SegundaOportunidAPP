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

                        <form action="{{ route('publicaciones.update', $publicacion->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @include('publicaciones._form')

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
