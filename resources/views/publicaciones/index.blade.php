@extends('layouts.app')

@section('titulo', 'Catálogo de Publicaciones - SegundaOportunidAPP')

@section('contenido')
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

        <form method="GET" action="{{ route('publicaciones.index') }}" class="row g-2 mb-4">
            <div class="col-md-6">
                <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control rounded-pill px-3"
                    placeholder="Buscar artículos por título o descripción...">
            </div>
            <div class="col-md-3">
                <select name="tipo" class="form-select rounded-pill px-3">
                    <option value="">Todos los tipos</option>
                    <option value="Venta" {{ request('tipo') === 'Venta' ? 'selected' : '' }}>Venta</option>
                    <option value="Donacion" {{ request('tipo') === 'Donacion' ? 'selected' : '' }}>Donación</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill w-100">Buscar</button>
                @if (request()->filled('buscar') || request()->filled('tipo'))
                    <a href="{{ route('publicaciones.index') }}" class="btn btn-outline-secondary rounded-pill">Limpiar</a>
                @endif
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

           

            {{-- TUS PUBLICACIONES REALES DE LA BASE DE DATOS --}}
            @forelse($publicaciones as $publicacion)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                        @if ($publicacion->foto)
                            <img src="{{ asset($publicacion->foto) }}" class="card-img-top"
                                alt="{{ $publicacion->titulo }}" style="height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">{{ $publicacion['titulo'] }}</h3>
                            <p class="texto-secundario text-muted flex-grow-1">
                                {{ Str::limit($publicacion['descripcion'], 80) }}</p>

                            <div class="d-flex gap-1 mb-3">
                                <span
                                    class="badge {{ $publicacion['tipo'] == 'Donacion' ? 'badge-donador' : 'badge-comprador' }}">
                                    {{ $publicacion['tipo'] }}
                                </span>
                                <span class="badge bg-light text-dark border">
                                    {{ $publicacion['estado_articulo'] }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top mb-2">
                                <span class="fw-bold text-primary fs-5">
                                    {{ $publicacion['precio'] > 0 ? '$' . number_format($publicacion['precio'], 2) : 'Gratis' }}
                                </span>
                                <div class="btn-group">
                                    <a href="{{ route('publicaciones.show', $publicacion['id']) }}"
                                        class="btn btn-sm btn-outline-primary rounded-start-pill">Ver</a>
                                    <a href="{{ route('publicaciones.edit', $publicacion['id']) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('mensajes.iniciar', $publicacion->id) }}"
                                    class="btn btn-sm btn-primary rounded-pill w-100 mt-1">
                                    <i class="bi bi-chat-dots"></i> Contactar Vendedor
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5 mb-3">No se encontraron publicaciones disponibles con esos criterios.</p>
                    <a href="{{ route('publicaciones.create') }}" class="btn btn-primary rounded-pill px-4">
                        Publicar el primer artículo
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
