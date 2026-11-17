@extends('layouts.app')

@section('titulo', 'Reportar Problema - SegundaOportunidAPP')

@section('contenido')
    <div class="container my-4" style="max-width: 700px;">

        <div class="p-4 p-md-5 bg-white border-0 rounded-4 shadow-sm text-center mb-4">
            <h1 class="titulo-principal mb-2">Formulario de Ayuda y Reportes</h1>
            <p class="texto-normal text-muted mb-0">
                Completa los siguientes datos para notificarnos cualquier inconveniente.
            </p>
        </div>

        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-body p-4 p-md-5">

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3" role="alert">
                        <strong>Completa correctamente los siguientes campos:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formReporte" action="{{ route('reportes.store') }}" method="POST" class="form-validado"
                    novalidate>
                    @csrf

                    <div id="alertaReporte" class="alert alert-danger d-none rounded-3" role="alert" aria-live="polite">
                        <strong id="mensajeAlertaReporte">
                            Completa correctamente los siguientes campos:
                        </strong>
                        <ul id="listaCamposReporte" class="mb-0 mt-2"></ul>
                    </div>

                    <div class="mb-4">
                        <label for="publicacionReporte" class="form-label texto-normal fw-bold">
                            Publicación reportada:
                        </label>
                        @if (isset($publicacion) && $publicacion)
                            <input type="hidden" name="publicacion_id" value="{{ $publicacion->id }}">
                            <input type="text" class="form-control rounded-3 p-2 bg-light"
                                value="{{ $publicacion->titulo ?? 'Publicación #' . $publicacion->id }}" readonly>
                        @else
                            <select class="form-select rounded-3 p-2" id="publicacionReporte" name="publicacion_id"
                                data-nombre="Publicación reportada" required>
                                <option value="" selected disabled>Selecciona la publicación</option>
                                @foreach ($publicaciones ?? [] as $pub)
                                    <option value="{{ $pub->id }}"
                                        {{ old('publicacion_id') == $pub->id ? 'selected' : '' }}>
                                        {{ $pub->titulo ?? 'Publicación #' . $pub->id }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Selecciona la publicación que deseas reportar.</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="nombreReporte" class="form-label texto-normal fw-bold">
                            Nombre:
                        </label>
                        <input type="text" class="form-control rounded-3 p-2" id="nombreReporte" name="nombre"
                            value="{{ old('nombre') }}" data-nombre="Nombre" placeholder="Escribe tu nombre"
                            pattern="[A-Za-zÁÉÍÓÚáéíóúÑñÜü ]{3,60}" required>
                        <div class="invalid-feedback">
                            Ingresa un nombre válido de 3 a 60 caracteres, utilizando solamente letras.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="correoReporte" class="form-label texto-normal fw-bold">
                            Correo electrónico:
                        </label>
                        <input type="email" class="form-control rounded-3 p-2" id="correoReporte" name="correo"
                            value="{{ old('correo') }}" data-nombre="Correo electrónico" placeholder="Escribe tu correo"
                            required>
                        <div class="invalid-feedback">
                            Ingresa un correo electrónico válido.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="asuntoReporte" class="form-label texto-normal fw-bold">
                            Tipo de reporte:
                        </label>
                        <select class="form-select rounded-3 p-2" id="asuntoReporte" name="motivo"
                            data-nombre="Tipo de reporte" required>
                            <option value="" selected disabled>Selecciona un motivo</option>
                            <option value="fallo" {{ old('motivo') == 'fallo' ? 'selected' : '' }}>Fallo en la página
                            </option>
                            <option value="duda" {{ old('motivo') == 'duda' ? 'selected' : '' }}>Duda sobre una donación
                            </option>
                            <option value="otro" {{ old('motivo') == 'otro' ? 'selected' : '' }}>Otro motivo</option>
                        </select>
                        <div class="invalid-feedback">
                            Selecciona un tipo de reporte.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="mensajeReporte" class="form-label texto-normal fw-bold">
                            Detalle del problema:
                        </label>
                        <textarea class="form-control rounded-3 p-2" id="mensajeReporte" name="descripcion" data-nombre="Detalle del problema"
                            rows="5" minlength="10" maxlength="500" placeholder="Explica qué sucedió..." required>{{ old('descripcion') }}</textarea>
                        <div class="invalid-feedback">
                            Describe el problema utilizando entre 10 y 500 caracteres.
                        </div>
                        <div class="form-text texto-secundario">
                            Máximo 500 caracteres.
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill texto-normal">
                            Enviar Reporte
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastReporte" class="toast border-0 shadow rounded-3" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header text-white" style="background-color: var(--color-menu);">
                <strong class="me-auto">SegundaOportunidAPP</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                    aria-label="Cerrar"></button>
            </div>
            <div class="toast-body bg-white text-dark rounded-bottom-3" id="mensajeToastReporte">
                Tu reporte se ha enviado correctamente.
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/toad.js') }}"></script>
@endpush
