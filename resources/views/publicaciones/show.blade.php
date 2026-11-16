@extends('layouts.app')

@section('titulo', $publicacion->titulo . ' - SegundaOportunidAPP')

@section('contenido')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    @if($publicacion->foto)
                        <div class="mb-4 text-center">
                            <img src="{{ asset($publicacion->foto) }}" alt="{{ $publicacion->titulo }}" class="img-fluid rounded-3" style="max-height: 400px; object-fit: cover;">
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="titulo">{{ $publicacion['titulo'] }}</h1>
                        <span class="badge fs-6 {{ $publicacion['tipo'] == 'Donacion' ? 'badge-donador' : 'badge-comprador' }}">
                            {{ $publicacion['tipo'] }}
                        </span>
                    </div>

                    <p class="fs-4 fw-bold text-primary mb-3">
                        {{ $publicacion['precio']>0?'' . number_format($publicacion['precio'], 2) . ' MXN' : 'Gratis / Donación' }}
                    </p>

                    <div class="mb-4">
                        <span class="badge bg-light text-dark border">Estado: {{ $publicacion['estado_articulo'] }}</span>
                    </div>
                
                    <h5 class="fw-bold">Descripción del artículo</h5>
                    <p class="text-secondary mb-4 fs-6" style="line-height: 1.6;">
                        {{ $publicacion['descripcion'] }}
                    </p>
                
                    
                        <div class="bg-light rounded-3 p-3 mt-3">
                            <h6 class="fw-bold mb-2">Información del anunciante</h6>
                            <p class="mb-1"><strong>Publicado por:</strong> {{ $publicacion->user->name ?? 'Usuario de SegundaOportunidAPP' }}</p>
                            @if($publicacion->user?->ciudad)
                                <p class="mb-1"><strong>Ciudad:</strong> {{ $publicacion->user->ciudad }}</p>
                            @endif
                            @if($publicacion->user?->telefono)
                                <p class="mb-0"><strong>Teléfono de contacto:</strong> {{ $publicacion->user->telefono }}</p>
                            @endif
                        </div>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('publicaciones.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            ← Volver al catálogo
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('publicaciones.edit', $publicacion['id']) }}" class="btn btn-warning text-white rounded-pill px-4">
                                Editar
                            </a>
                            <form action="{{ route('publicaciones.destroy', $publicacion['id']) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger rounded-pill px-4">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
