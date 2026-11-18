@extends('layouts.app')
@include('transacciones._recursos')
@section('titulo', ($aportacion->exists ? 'Editar aportación' : 'Aportación económica') . ' - SegundaOportunidAPP')
@section('content')
<div class="transacciones">
    <header class="transacciones__cabecera"><div><h1>{{ $aportacion->exists ? 'Editar aportación' : 'Aportación económica' }}</h1><p>Comparte los datos de tu aportación para su revisión.</p></div></header>
    <div class="transacciones__grid"><section class="transacciones__contenido transacciones__contenido--estrecho transacciones__tarjeta">
        <h2>Datos de la aportación</h2>
        <p class="transacciones__ayuda">Los campos marcados con * son obligatorios.</p>
        <div class="transacciones__aviso">Registra una aportación realizada por fuera y adjunta su comprobante. El registro queda pendiente de revisión; esta aplicación no cobra ni verifica el pago.</div>
        <form method="POST" enctype="multipart/form-data" action="{{ $aportacion->exists ? route('aportaciones.update', $aportacion) : route('aportaciones.store') }}">
            @csrf
            @if($aportacion->exists) @method('PUT') @endif
            @foreach(['nombre' => 'Nombre completo', 'correo' => 'Correo electrónico', 'monto' => 'Monto en MXN', 'referencia' => 'Referencia de operación'] as $campo => $etiqueta)
                <div class="transacciones__grupo">
                    <label class="form-label" for="{{ $campo }}">{{ $etiqueta }} *</label>
                    <input class="form-control @error($campo) is-invalid @enderror" id="{{ $campo }}" name="{{ $campo }}" type="{{ $campo === 'correo' ? 'email' : ($campo === 'monto' ? 'number' : 'text') }}"
                        @if($campo === 'monto') min="0.01" max="99999999.99" step="0.01" @endif
                        @if($campo === 'nombre') maxlength="120" @elseif($campo === 'correo') maxlength="254" @elseif($campo === 'referencia') maxlength="100" @endif
                        value="{{ old($campo, $aportacion->$campo) }}" required @error($campo) aria-invalid="true" aria-describedby="error-{{ $campo }}" @enderror>
                    @error($campo)<div class="invalid-feedback" id="error-{{ $campo }}">{{ $message }}</div>@enderror
                </div>
            @endforeach
            <div class="transacciones__grupo">
                <label class="form-label" for="comprobante">Comprobante {{ $aportacion->exists ? '(opcional para reemplazar)' : '*' }}</label>
                <input type="file" class="form-control @error('comprobante') is-invalid @enderror" id="comprobante" name="comprobante" accept=".pdf,.jpg,.jpeg,.png" @if(!$aportacion->exists) required @endif aria-describedby="ayuda-comprobante @error('comprobante') error-comprobante @enderror" @error('comprobante') aria-invalid="true" @enderror>
                <div class="form-text" id="ayuda-comprobante">PDF, JPG o PNG; máximo 2 MB.</div>
                @error('comprobante')<div class="invalid-feedback" id="error-comprobante">{{ $message }}</div>@enderror
            </div>
            <div class="form-check transacciones__grupo">
                <input type="checkbox" class="form-check-input @error('confirmacion') is-invalid @enderror" id="confirmacion" name="confirmacion" value="1" @checked(old('confirmacion')) required @error('confirmacion') aria-invalid="true" aria-describedby="error-confirmacion" @enderror>
                <label class="form-check-label" for="confirmacion">Confirmo que los datos corresponden a mi operación *</label>
                @error('confirmacion')<div class="invalid-feedback" id="error-confirmacion">{{ $message }}</div>@enderror
            </div>
            <div class="transacciones__acciones"><a class="btn btn-outline-secondary" href="{{ route('aportaciones.index') }}">Cancelar</a><button class="btn btn-primary" type="submit">{{ $aportacion->exists ? 'Guardar cambios' : 'Guardar aportación' }}</button></div>
        </form>
    </section></div>
</div>
@endsection
