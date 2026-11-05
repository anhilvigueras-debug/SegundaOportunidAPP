@extends('layouts.app')

@section('title', $publicacion['titulo'] . ' - SegundaOportunidAPP')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="titulo">{{ $publicacion['titulo'] }}</h1>
                        <span class="badge fs-6 {{ $publicacion['tipo'] == 'Donacion' ? 'badge-donador' : 'badge-comprador' }}">
                            {{ $publicacion['tipo'] }}
                        </span>
                    </div>

                    <p class="fs-4 fw-bold text-primary mb-3">
                        {{ publicacion['precio']>0?'' . number_format($publicacion['precio'], 2) . ' MXN' : 'Gratis / Donación' }}
                    </p>

                    <div class="mb-4">
                        <span class="badge bg-light text-dark border">Estado: {{ $publicacion['estado_articulo'] }}</span>
                    </div>

                    <h5 class="fw-bold">Descripción del artículo</h5>
                    <p class="text-secondary mb-4 fs-6" style="line-height: 1.6;">
                        {{ $publicacion['descripcion'] }}
                    </p>

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
