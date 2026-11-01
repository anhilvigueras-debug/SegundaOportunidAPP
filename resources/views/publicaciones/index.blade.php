@extends('layouts.app')

@section('title', 'Inicio - SegundaOportunidAPP')

@section('content')
<section class="container mb-5">
    <div class="p-4 p-md-5 bg-white border-0 rounded-4 shadow-sm text-center text-md-start">
        <h1 class="titulo-principal mb-2">Bienvenido a SegundaOportunidAPP</h1>
        <p class="texto-normal text-muted mb-0">Dándole una segunda vida a los objetos y apoyando a la comunidad.</p>
    </div>
</section>

<section class="container mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <div>
            <h2 class="subtitulo mb-0">Catálogo de Publicaciones</h2>
        </div>
        <div>
            <a href="{{ route('publicaciones.create') }}" class="btn btn-primary rounded-pill">
                + Nueva Publicación
            </a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
        @forelse($publicaciones as $publicacion)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <div class="card-body d-flex flex-column p-3">
                        <h3 class="encabezado mb-2">{{ $publicacion->titulo }}</h3>
                        <p class="texto-secundario text-muted flex-grow-1 mb-2">{{ $publicacion->descripcion }}</p>
                        
                        <div class="d-flex gap-1 mb-3">
                            <span class="badge {{ $publicacion->tipo == 'Donacion' ? 'badge-donador' : 'badge-comprador' }}">
                                {{ $publicacion->tipo }}
                            </span>
                            <span class="badge bg-secondary">{{ $publicacion->estado_articulo }}</span>
                        </div>

                        <p class="fw-bold mb-3 text-primary">
                            {{ $publicacion->precio > 0 ? '$' . number_format($publicacion->precio, 2) : 'Gratis' }}
                        </p>

                        <a href="{{ route('publicaciones.show', $publicacion) }}" class="btn btn-primary w-100 rounded-pill texto-secundario text-center">
                            Ver detalle
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 w-100 text-center py-5">
                <p class="text-muted fs-5">Aún no hay publicaciones registradas.</p>
                <a href="{{ route('publicaciones.create') }}" class="btn btn-primary rounded-pill">Crear la primera publicación</a>
            </div>
        @endforelse
    </div>
</section>
@endsection