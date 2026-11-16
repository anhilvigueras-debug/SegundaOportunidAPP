@extends('layouts.app')

@section('titulo', 'Iniciar Sesión - SegundaOportunidAPP')

@section('contenido')
    <div class="container my-4" style="max-width: 500px;">

        <section class="card border-0 shadow-sm p-4 mb-4 rounded-3 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png"
                 alt="Icono de usuario"
                 width="70"
                 class="mx-auto mb-3">

            <h2 class="subtitulo">Acceso a tu cuenta</h2>

            <p class="texto-normal text-muted mb-0">
                Ingresa tu correo y contraseña para continuar.
            </p>
        </section>

        <section class="card border-0 shadow-sm p-4 rounded-3">

            <h3 class="encabezado mb-3 text-dark">Iniciar sesión</h3>

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

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div id="alertaLogin"
                     class="alert alert-danger d-none rounded-3"
                     role="alert"
                     aria-live="polite">
                    <strong id="mensajeAlertaLogin">
                        Corrige los siguientes campos:
                    </strong>
                    <ul id="listaCamposLogin" class="mb-0 mt-2"></ul>
                </div>

                <div class="mb-3">
                    <label for="loginEmail" class="form-label texto-normal fw-bold">
                        Correo electrónico:
                    </label>

                    <input type="email"
                           class="form-control rounded-3 p-2"
                           id="loginEmail"
                           name="loginEmail"
                           value="{{ old('loginEmail') }}"
                           data-nombre="Correo electrónico"
                           placeholder="ejemplo@correo.com"
                           required>

                    <div class="invalid-feedback">
                        Ingresa un correo electrónico válido.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="loginPassword" class="form-label texto-normal fw-bold">
                        Contraseña:
                    </label>

                    <input type="password"
                           class="form-control rounded-3 p-2"
                           id="loginPassword"
                           name="loginPassword"
                           data-nombre="Contraseña"
                           minlength="8"
                           pattern="(?=.*[A-Z])(?=.*[0-9]).{8,}"
                           title="Mínimo 8 caracteres, una mayúscula y un número."
                           required>

                    <div class="invalid-feedback">
                        La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.
                    </div>
                </div>

                <button type="submit"
                        class="btn btn-primary w-100 py-2 mt-2 rounded-pill texto-normal">
                    Ingresar
                </button>


            </form>
            <p class="text-center mt-3 mb-0 texto-normal">
                ¿Aún no tienes cuenta? 
                <a href="{{ route('registro') }}" class="fw-bold text-primary text-decoration-none">Regístrate aquí</a>
            </p>

            <hr style="border-color: var(--color-bordes);" class="my-4">

            <div class="texto-secundario text-muted">
                <p class="fw-bold mb-1">Requisitos de la cuenta:</p>

                <ul class="mb-0 ps-3">
                    <li>La contraseña debe tener mínimo 8 caracteres.</li>
                    <li>Debe incluir al menos una letra mayúscula.</li>
                    <li>Debe incluir al menos un número.</li>
                </ul>
            </div>

        </section>
    </div>
@endsection