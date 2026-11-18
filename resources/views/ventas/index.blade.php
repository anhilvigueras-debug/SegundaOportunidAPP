@extends('layouts.app')
@include('transacciones._recursos')
@section('titulo', 'Ventas registradas - SegundaOportunidAPP')
@section('content')
<div class="transacciones">
    <header class="transacciones__cabecera">
        <div><h1>Ventas registradas</h1><p>Consulta el monto y la comisión calculada de cada venta.</p></div>
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">Registrar venta</a>
    </header>
    <div class="transacciones__grid"><section class="transacciones__contenido transacciones__tarjeta" aria-label="Listado de ventas">
        <div class="table-responsive"><table class="table transacciones__tabla">
            <thead><tr><th scope="col">Artículo</th><th scope="col">Comprador</th><th scope="col">Venta</th><th scope="col">Comisión</th><th scope="col">Acciones</th></tr></thead>
            <tbody>@forelse($ventas as $venta)
                <tr><td data-label="Artículo">{{ $venta->publicacion->titulo }}</td><td data-label="Comprador">{{ $venta->comprador }}</td><td data-label="Venta">${{ $venta->monto }} MXN</td><td data-label="Comisión">${{ $venta->comision }} MXN</td><td data-label="Acciones"><a href="{{ route('ventas.show', $venta) }}" aria-label="Ver detalle de {{ $venta->publicacion->titulo }}">Ver detalle</a></td></tr>
            @empty
                <tr><td colspan="5" class="transacciones__vacio">Aún no hay ventas registradas. <a href="{{ route('ventas.create') }}">Registra la primera venta</a>.</td></tr>
            @endforelse</tbody>
        </table></div>
        <div class="transacciones__paginacion">{{ $ventas->links('pagination::bootstrap-5') }}</div>
    </section></div>
</div>
@endsection
