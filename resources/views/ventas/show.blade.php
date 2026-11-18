@extends('layouts.app')
@include('transacciones._recursos')
@section('titulo', 'Detalle de venta - SegundaOportunidAPP')
@section('content')
<div class="transacciones">
    <header class="transacciones__cabecera"><div><h1>Detalle de venta</h1><p>Consulta la información de la venta y su comisión.</p></div></header>
    <div class="transacciones__grid"><article class="transacciones__contenido transacciones__contenido--estrecho transacciones__tarjeta">
        <h2>Resumen de la operación</h2>
        <dl class="transacciones__detalle">
            <div><dt>Artículo</dt><dd>{{ $venta->publicacion->titulo }}</dd></div>
            <div><dt>Comprador</dt><dd>{{ $venta->comprador }}</dd></div>
            <div><dt>Monto de venta</dt><dd>${{ $venta->monto }} MXN</dd></div>
            <div><dt>Comisión ({{ $venta->comision_puntos_base / 100 }}%)</dt><dd>${{ $venta->comision }} MXN</dd></div>
            <div><dt>Monto restante para el vendedor</dt><dd>${{ $venta->monto_vendedor }} MXN</dd></div>
        </dl>
        <div class="transacciones__aviso mt-4">Este registro no procesa ni confirma un pago.</div>
        <div class="transacciones__acciones">
            <a class="btn btn-outline-secondary" href="{{ route('ventas.index') }}">Volver</a>
            <a class="btn btn-primary" href="{{ route('ventas.edit', $venta) }}">Editar</a>
            <form method="POST" action="{{ route('ventas.destroy', $venta) }}" data-confirmar="¿Eliminar el registro de venta?">
                @csrf @method('DELETE')<button class="btn btn-outline-danger" type="submit">Eliminar</button>
            </form>
        </div>
    </article></div>
</div>
@endsection
