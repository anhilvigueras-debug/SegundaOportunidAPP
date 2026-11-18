@extends('layouts.app')
@include('transacciones._recursos')
@section('titulo', 'Detalle de aportación - SegundaOportunidAPP')
@section('content')
<div class="transacciones">
    <header class="transacciones__cabecera"><div><h1>Detalle de aportación</h1><p>Consulta los datos y el comprobante de la operación.</p></div></header>
    <div class="transacciones__grid"><article class="transacciones__contenido transacciones__contenido--estrecho transacciones__tarjeta">
        <h2>Resumen de la aportación</h2>
        <div class="transacciones__aviso mt-4">Comprobante pendiente de revisión. Este registro no confirma que se haya recibido el dinero.</div>
        <dl class="transacciones__detalle">
            <div><dt>Nombre</dt><dd>{{ $aportacion->nombre }}</dd></div>
            <div><dt>Correo</dt><dd>{{ $aportacion->correo }}</dd></div>
            <div><dt>Monto</dt><dd>${{ $aportacion->monto }} MXN</dd></div>
            <div><dt>Referencia</dt><dd>{{ $aportacion->referencia }}</dd></div>
            <div><dt>Comprobante</dt><dd><a class="transacciones__enlace" href="{{ route('aportaciones.comprobante', $aportacion) }}">Descargar {{ $aportacion->comprobante_nombre }}</a></dd></div>
        </dl>
        <div class="transacciones__acciones">
            <a class="btn btn-outline-secondary" href="{{ route('aportaciones.index') }}">Volver</a>
            <a class="btn btn-primary" href="{{ route('aportaciones.edit', $aportacion) }}">Editar</a>
            <form method="POST" action="{{ route('aportaciones.destroy', $aportacion) }}" data-confirmar="¿Eliminar la aportación y su comprobante?">
                @csrf @method('DELETE')<button class="btn btn-outline-danger" type="submit">Eliminar</button>
            </form>
        </div>
    </article></div>
</div>
@endsection
