@extends('layouts.app')

@section('title', 'Catálogo de Publicaciones - SegundaOportunidAPP')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="titulo">Catálogo de Artículos</h1>
            <p class="texto-secundario text-muted">Donaciones y artículos de segunda mano disponibles</p>
        </div>
        <a href="{{ route('publicaciones.create') }}" class="btn btn-primary rounded-pill px-4">
            + Nueva Publicación
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
        @forelse($publicaciones as $publicacion)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="card-body d-flex flex-column p-3">
                        <h3 class="encabezado mb-2">{{ $publicacion['titulo'] }}</h3>
                        <p class="texto-secundario text-muted flex-grow-1">{{ Str::limit($publicacion['descripcion'], 80) }}</p>
                        
                        <div class="d-flex gap-1 mb-3">
                            <span class="badge {{ $publicacion['tipo'] == 'Donacion' ? 'badge-donador' : 'badge-comprador' }}">
                                {{ $publicacion['tipo'] }}
                            </span>
                            <span class="badge bg-light text-dark border">
                                {{ $publicacion['estado_articulo'] }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-bold text-primary fs-5">
                                {{ $publicacion['precio'] > 0 ? '$' . number_format($publicacion['precio'], 2) : 'Gratis' }}
                            </span>
                            <div class="btn-group">
                                <a href="{{ route('publicaciones.show', $publicacion['id']) }}" class="btn btn-sm btn-outline-primary rounded-start-pill">Ver</a>
                                <a href="{{ route('publicaciones.edit', $publicacion['id']) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">No hay publicaciones registradas por el momento.</p>
                <a href="{{ route('publicaciones.create') }}" class="btn btn-primary rounded-pill">Crear la primera publicación</a>
            </div>
        @endforelse
    </div>
</div>
@endsection