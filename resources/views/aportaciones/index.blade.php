@extends('layouts.app')
@include('transacciones._recursos')
@section('titulo', 'Aportaciones - SegundaOportunidAPP')
@section('content')
<div class="transacciones">
    <header class="transacciones__cabecera">
        <div><h1>Aportaciones</h1><p>Consulta las operaciones registradas y pendientes de revisión.</p></div>
        <a class="btn btn-primary" href="{{ route('aportaciones.create') }}">Registrar aportación</a>
    </header>
    <div class="transacciones__grid"><section class="transacciones__contenido transacciones__tarjeta" aria-label="Listado de aportaciones">
        <div class="table-responsive"><table class="table transacciones__tabla">
            <thead><tr><th scope="col">Nombre</th><th scope="col">Referencia</th><th scope="col">Monto</th><th scope="col">Acciones</th></tr></thead>
            <tbody>@forelse($aportaciones as $aportacion)
                <tr><td data-label="Nombre">{{ $aportacion->nombre }}</td><td data-label="Referencia">{{ $aportacion->referencia }}</td><td data-label="Monto">${{ $aportacion->monto }} MXN</td><td data-label="Acciones"><a href="{{ route('aportaciones.show', $aportacion) }}" aria-label="Ver detalle de la aportación {{ $aportacion->referencia }}">Ver detalle</a></td></tr>
            @empty
                <tr><td colspan="4" class="transacciones__vacio">Aún no hay aportaciones registradas. <a href="{{ route('aportaciones.create') }}">Registrar aportación</a>.</td></tr>
            @endforelse</tbody>
        </table></div>
        <div class="transacciones__paginacion">{{ $aportaciones->links('pagination::bootstrap-5') }}</div>
    </section></div>
</div>
@endsection
