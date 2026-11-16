@extends('layouts.app')

@section('titulo', 'Contacto - SegundaOportunidAPP')

@section('contenido')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">

                <div class="p-4 bg-white border-0 rounded-4 shadow-sm text-center mb-4">
                    <h1 class="titulo-principal mb-2">Formulario de contacto</h1>
                    <p class="texto-normal text-muted mb-0">
                        Completa correctamente todos los campos para enviar tu mensaje.
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

                        <form id="formularioContacto" action="" method="POST" class="form-validado" novalidate>
                            @csrf

                            <div class="alert alert-danger alerta-validacion d-none rounded-3" role="alert" aria-live="polite">
                                <strong class="mensaje-alerta">Completa correctamente los siguientes campos:</strong>
                                <ul class="lista-campos mb-0 mt-2"></ul>
                            </div>

                            <div class="mb-4">
                                <label for="nombre" class="form-label texto-normal fw-bold">Nombre</label>
                                <input type="text" class="form-control rounded-3 p-2" id="nombre" name="nombre" value="{{ old('nombre') }}" data-nombre="Nombre" placeholder="Escribe tu nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñÜü ]{3,60}" required>
                                <div class="invalid-feedback">
                                    Ingresa un nombre válido de al menos 3 caracteres y utiliza solamente letras.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="correo" class="form-label texto-normal fw-bold">Correo electrónico</label>
                                <input type="email" class="form-control rounded-3 p-2" id="correo" name="correo" value="{{ old('correo') }}" data-nombre="Correo electrónico" placeholder="ejemplo@correo.com" required>
                                <div class="invalid-feedback">
                                    Ingresa un correo electrónico válido.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="asunto" class="form-label texto-normal fw-bold">Asunto</label>
                                <input type="text" class="form-control rounded-3 p-2" id="asunto" name="asunto" value="{{ old('asunto') }}" data-nombre="Asunto" placeholder="Escribe el asunto" pattern=".{3,100}" required>
                                <div class="invalid-feedback">
                                    El asunto debe contener entre 3 y 100 caracteres.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="mensaje" class="form-label texto-normal fw-bold">Mensaje</label>
                                <textarea class="form-control rounded-3 p-2" id="mensaje" name="mensaje" data-nombre="Mensaje" rows="5" minlength="10" maxlength="500" placeholder="Escribe tu mensaje..." required>{{ old('mensaje') }}</textarea>
                                <div class="invalid-feedback">
                                    El mensaje debe contener al menos 10 caracteres.
                                </div>
                                <div class="form-text texto-secundario">
                                    Máximo 500 caracteres.
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill texto-normal">
                                    Enviar mensaje
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection