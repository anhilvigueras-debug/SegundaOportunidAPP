<!DOCTYPE html>
<html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'SegundaOportunidAPP')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
<link rel="stylesheet" href="{{ asset('css/transacciones.css') }}">@stack('styles')</head>
<body><nav class="navbar navbar-expand-lg navbar-dark navbar-principal"><div class="container">
<a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('publicaciones.index') }}"><img src="{{ asset('img/logo.jpeg') }}" alt="" width="40" height="40" class="rounded-circle"><span>SegundaOportunidAPP</span></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-label="Abrir menú"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="menu"><div class="navbar-nav ms-auto">
<a class="nav-link" href="{{ route('publicaciones.index') }}">Catálogo</a><a class="nav-link" href="{{ route('publicaciones.create') }}">Publicar</a><a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a><a class="nav-link" href="{{ route('aportaciones.create') }}">Aportar</a><a class="nav-link" href="{{ route('aportaciones.index') }}">Aportaciones</a>
</div></div></div></nav><main class="container py-4">
@if(session('success')) <div class="alert alert-success" role="status">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger" role="alert">{{ session('error') }}</div> @endif
@yield('content')</main>@include('partials.footer')<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></body></html>
