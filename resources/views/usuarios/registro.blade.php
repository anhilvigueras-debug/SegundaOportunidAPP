@extends('layouts.app')

@section('titulo', 'Registro - SegundaOportunidAPP')

@section('contenido')
    <div class="container my-4" style="max-width: 550px;">

        <section class="card border-0 shadow-sm p-4 mb-4 rounded-3 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png"
                 alt="Icono de registro"
                 width="70"
                 class="mx-auto mb-3">

            <h2 class="subtitulo">Crea tu cuenta</h2>

            <p class="texto-normal text-muted mb-0">
                Únete a SegundaOportunidAPP para publicar y dar una segunda vida a tus artículos.
            </p>
        </section>

        <section class="card border-0 shadow-sm p-4 rounded-3">

            <h3 class="encabezado mb-3 text-dark">Registro de usuario</h3>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3" role="alert">
                    <strong>Corrige los siguientes campos:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formularioRegistro" action="{{ route('registro.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label texto-normal fw-bold">Nombre completo:</label>
                    <input type="text"
                           class="form-control rounded-3 p-2"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           data-nombre="Nombre completo"
                           placeholder="Tu nombre y apellidos"
                           required>
                    <div class="invalid-feedback">Ingresa tu nombre completo.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label texto-normal fw-bold">Correo electrónico:</label>
                    <input type="email"
                           class="form-control rounded-3 p-2"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           data-nombre="Correo electrónico"
                           placeholder="ejemplo@correo.com"
                           required>
                    <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label texto-normal fw-bold">Teléfono (opcional):</label>
                        <input type="text"
                               class="form-control rounded-3 p-2"
                               id="telefono"
                               name="telefono"
                               value="{{ old('telefono') }}"
                               placeholder="771 123 4567"
                               maxlength="15">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="ciudad" class="form-label texto-normal fw-bold">Ciudad (opcional):</label>
                        <input type="text"
                               class="form-control rounded-3 p-2"
                               id="ciudad"
                               name="ciudad"
                               value="{{ old('ciudad') }}"
                               placeholder="Ej. Pachuca, Hgo."
                               maxlength="100">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label texto-normal fw-bold">Contraseña:</label>
                    <input type="password"
                           class="form-control rounded-3 p-2"
                           id="password"
                           name="password"
                           data-nombre="Contraseña"
                           minlength="8"
                           pattern="(?=.*[A-Z])(?=.*[0-9]).{8,}"
                           title="Mínimo 8 caracteres, una mayúscula y un número."
                           required>
                    <div class="invalid-feedback">
                        La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label texto-normal fw-bold">Confirmar contraseña:</label>
                    <input type="password"
                           class="form-control rounded-3 p-2"
                           id="password_confirmation"
                           name="password_confirmation"
                           data-nombre="Confirmar contraseña"
                           minlength="8"
                           required>
                    <div class="invalid-feedback">Confirma tu contraseña.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mt-2 rounded-pill texto-normal">
                    Registrarme
                </button>

                <div class="text-center mt-3">
                    <span class="texto-secundario text-muted">¿Ya tienes una cuenta?</span>
                    <a href="{{ route('login') }}" class="texto-secundario fw-bold text-decoration-none">
                        Inicia sesión
                    </a>
                </div>
            </form>

        </section>
    </div>
@endsection