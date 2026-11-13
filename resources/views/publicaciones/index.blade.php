@extends('layouts.app')
@section('title','Catálogo')
@section('content')
<div class="d-flex flex-wrap justify-content-between gap-2 mb-4"><div><h1>Catálogo</h1><p>Artículos de segunda mano y donaciones.</p></div><a href="{{ route('publicaciones.create') }}" class="btn btn-primary align-self-start">Nueva publicación</a></div>
<div class="row g-3">@forelse($publicaciones as $publicacion)<div class="col-md-6 col-lg-4"><article class="card h-100"><div class="card-body d-flex flex-column"><h2 class="h5">{{ $publicacion->titulo }}</h2><p>{{ Str::limit($publicacion->descripcion, 100) }}</p><p>{{ $publicacion->tipo }} · ${{ number_format((float)$publicacion->precio, 2) }} MXN</p><div class="mt-auto"><a class="btn btn-outline-primary btn-sm" href="{{ route('publicaciones.show',$publicacion) }}">Ver</a> <a class="btn btn-outline-secondary btn-sm" href="{{ route('publicaciones.edit',$publicacion) }}">Editar</a></div></div></article></div>@empty <p>No hay publicaciones. Crea una para comenzar.</p> @endforelse</div><div class="mt-3">{{ $publicaciones->links() }}</div>
@endsection
