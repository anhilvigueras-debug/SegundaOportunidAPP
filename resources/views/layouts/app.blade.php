<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'SegundaOportunidAPP')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    @stack('estilos')
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top shadow-sm" style="background-color: var(--color-menu);">
        <nav class="navbar navbar-expand-lg navbar-dark container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('inicio') }}">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo de SegundaOportunidAPP" height="40"
                    class="rounded-circle">
                <span>SegundaOportunidAPP</span>
            </a>

            <button id="btn-tema" class="btn btn-outline-light btn-sm ms-3" type="button">🌙 Tema Oscuro</button>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-1 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inicio') ? 'active fw-bold' : '' }}"
                            href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('publicaciones.*') ? 'active fw-bold' : '' }}"
                            href="{{ route('publicaciones.index') }}">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('nosotros') ? 'active fw-bold' : '' }}"
                            href="{{ route('nosotros') }}">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('servicios') ? 'active fw-bold' : '' }}"
                            href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('donaciones') ? 'active fw-bold' : '' }}"
                            href="{{ route('donaciones') }}">Donaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active fw-bold' : '' }}"
                            href="{{ route('contacto') }}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reporte') ? 'active fw-bold' : '' }}"
                            href="{{ route('reporte') }}">Reportar problema</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mensaje') ? 'active fw-bold' : '' }}"
                            href="{{ route('mensajes.index') }}">mensajes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('aportaciones.create') }}">Aportar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('aportaciones.index') }}">Aportaciones</a>
                    </li>

                    @guest
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-outline-light btn-sm px-3 rounded-pill texto-secundario"
                                href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                        <li class="nav-item ms-lg-1 mt-2 mt-lg-0">
                            <a class="btn btn-light btn-sm px-3 rounded-pill texto-secundario fw-bold"
                                href="{{ route('registro') }}">Registrarse</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-outline-light btn-sm px-3 rounded-pill texto-secundario {{ request()->routeIs('perfil') ? 'active fw-bold' : '' }}"
                                href="{{ route('perfil') }}">
                                Mi Perfil
                            </a>
                        </li>
                        <li class="nav-item ms-lg-1 mt-2 mt-lg-0">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-light btn-sm px-3 rounded-pill texto-secundario">
                                    Salir
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>

    <main class="py-4 flex-grow-1">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success" role="status">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif
        </div>
        @yield('contenido')
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="text-white py-4 mt-auto shadow-sm" style="background-color: var(--color-menu);">
        <div class="container text-center text-md-start">
            <div class="row gy-3 align-items-center">
                <div class="col-md-6">
                    <h5 class="encabezado text-white mb-1">SegundaOportunidAPP</h5>
                    <p class="texto-secundario text-white-50 mb-0">Dándole una segunda vida a los objetos y apoyando a
                        la comunidad.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="texto-secundario text-white mb-0">&copy; 2026 SegundaOportunidAPP. Todos los derechos
                        reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Detalle Producto -->
    <div class="modal fade" id="modalDinamico" tabindex="-1" aria-labelledby="modalTitulo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h3 class="modal-title encabezado" id="modalTitulo">Detalle del Producto</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4">
                    <img id="modalImagen" src="" class="img-fluid rounded-3 mb-3 w-100"
                        style="max-height: 250px; object-fit: cover;" alt="Imagen del producto">
                    <p id="modalDescripcion" class="texto-normal"></p>
                    <p id="modalPrecio" class="fw-bold fs-5 text-primary"></p>
                    <hr>
                    <h5 class="encabezado">Ubicación</h5>
                    <p id="modalUbicacion" class="texto-secundario text-muted mb-3"></p>
                    <h5 class="encabezado">Contacto</h5>
                    <ul class="list-unstyled mb-0 texto-secundario text-muted">
                        <li><strong>Contacto:</strong> <span id="modalVendedor"></span></li>
                        <li><strong>Teléfono:</strong> <a id="modalTelefono" href=""
                                class="text-decoration-none"></a></li>
                        <li><strong>Correo:</strong> <a id="modalCorreo" href=""
                                class="text-decoration-none"></a></li>
                    </ul>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 texto-secundario"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmación Donación -->
    <div class="modal fade" id="modalConfirmacionDonacion" tabindex="-1" aria-labelledby="tituloModalDonacion"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h3 class="modal-title encabezado" id="tituloModalDonacion">¡Donación Registrada!</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="texto-normal text-muted mb-0">Gracias por tu donación. Los datos han sido registrados
                        correctamente y tu artículo estará disponible en breve.</p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-primary rounded-pill px-4 texto-secundario"
                        data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/modales.js') }}"></script>
    <script src="{{ asset('js/busqueda.js') }}"></script>
    <script src="{{ asset('js/validaciones.js') }}"></script>
    @stack('scripts')
</body>

</html>
