@extends('layouts.app')

@section('titulo', 'Mi Perfil - SegundaOportunidAPP')

@section('contenido')
    <div class="container my-4" style="max-width: 700px;">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm" role="alert">
                <strong>Corrige los siguientes campos:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tarjeta superior con datos actuales -->
        <section class="card border-0 shadow-sm p-4 mb-4 rounded-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3 text-center text-md-start flex-column flex-md-row">
                    <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png"
                         alt="Avatar de usuario"
                         width="80"
                         class="rounded-circle border p-1">

                    <div>
                        <h2 class="subtitulo mb-1">{{ $usuario->name }}</h2>
                        <p class="texto-normal text-muted mb-1">{{ $usuario->email }}</p>
                        <div class="texto-secundario text-muted">
                            <span class="me-3">
                                <strong>Teléfono:</strong> {{ $usuario->telefono ?: 'No registrado' }}
                            </span>
                            <span>
                                <strong>Ciudad:</strong> {{ $usuario->ciudad ?: 'No registrada' }}
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-4 texto-normal">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </section>

        <!-- Formulario para actualizar datos del perfil -->
        <section class="card border-0 shadow-sm p-4 rounded-3">
            <h3 class="encabezado mb-3 text-dark">Editar información personal</h3>

            <form action="{{ route('perfil.actualizar') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label texto-normal fw-bold">Nombre completo:</label>
                    <input type="text"
                           class="form-control rounded-3 p-2"
                           id="name"
                           name="name"
                           value="{{ old('name', $usuario->name) }}"
                           required>
                    <div class="invalid-feedback">El nombre es obligatorio.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label texto-normal fw-bold">Correo electrónico:</label>
                    <input type="email"
                           class="form-control rounded-3 p-2 bg-light"
                           id="email"
                           value="{{ $usuario->email }}"
                           disabled>
                    <small class="text-muted">El correo electrónico no puede modificarse.</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label texto-normal fw-bold">Teléfono:</label>
                        <input type="text"
                               class="form-control rounded-3 p-2"
                               id="telefono"
                               name="telefono"
                               value="{{ old('telefono', $usuario->telefono) }}"
                               placeholder="771 123 4567"
                               maxlength="15">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="ciudad" class="form-label texto-normal fw-bold">Ciudad:</label>
                        <input type="text"
                               class="form-control rounded-3 p-2"
                               id="ciudad"
                               name="ciudad"
                               value="{{ old('ciudad', $usuario->ciudad) }}"
                               placeholder="Ej. Pachuca, Hgo."
                               maxlength="100">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mt-2 rounded-pill texto-normal">
                    Guardar cambios
                </button>
            </form>
        </section>
        <!-- Historial de publicaciones del usuario -->
        <section class="card border-0 shadow-sm p-4 mt-4 rounded-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="encabezado mb-0 text-dark">Mis publicaciones</h3>
                <a href="{{ route('publicaciones.create') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                    + Nueva
                </a>
            </div>

            @forelse($publicaciones as $item)
                <div class="border rounded-3 p-3 mb-2 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <strong>{{ $item->titulo }}</strong>
                            @if($item->disponible)
                                <span class="badge bg-success">Activa</span>
                            @else
                                <span class="badge bg-secondary">Finalizada</span>
                            @endif
                        </div>
                        <small class="text-muted">
                            {{ $item->tipo }} · {{ $item->precio > 0 ? '$' . number_format($item->precio, 2) : 'Gratis' }}
                        </small>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('publicaciones.show', $item) }}" class="btn btn-sm btn-outline-primary rounded-pill">Ver</a>
                        <a href="{{ route('publicaciones.edit', $item) }}" class="btn btn-sm btn-outline-secondary rounded-pill">Editar</a>

                        @if($item->disponible)
                            <form action="{{ route('publicaciones.finalizar', $item) }}" method="POST" onsubmit="return confirm('¿Marcar este artículo como vendido/entregado y retirarlo del catálogo público?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success rounded-pill">
                                    Marcar finalizada
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted mb-0">Aún no has publicado ningún artículo.</p>
            @endforelse
        </section>

    </div>
@endsection