@extends('layouts.app')

@section('titulo', 'Mensajes - SegundaOportunidAPP')

@section('contenido')
    <div class="container py-2">
        <div class="p-4 bg-white border-0 rounded-4 shadow-sm mb-4">
            <h1 class="titulo-principal mb-2">Centro de mensajes</h1>
            <p class="texto-normal text-muted mb-0">
                Consulta tus conversaciones con compradores, vendedores y donadores relacionadas a tus publicaciones.
            </p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row g-4">
            {{-- COLUMNA IZQUIERDA: CONVERSACIONES REALES --}}
            <div class="col-12 col-lg-4">
                <section class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                    <div class="card-body p-0">
                        <div class="p-3 border-bottom bg-light">
                            <h2 class="subtitulo mb-2">Conversaciones</h2>
                            <input type="text" id="campoBusqueda" class="form-control rounded-pill shadow-sm"
                                placeholder="Buscar conversación">
                        </div>
                        <div class="list-group list-group-flush" id="listaChats">
                            @forelse($conversaciones as $conv)
                                @php
                                    $esComprador = $conv->comprador_id === Auth::id();
                                    $interlocutor = $esComprador ? $conv->vendedor : $conv->comprador;
                                    $badgeTexto = $esComprador ? 'Vendedor' : 'Comprador';
                                    $claseBadge = $esComprador ? 'bg-success' : 'bg-primary';
                                    $isActive = isset($conversacionActiva) && $conversacionActiva->id === $conv->id;
                                    $ultimoMensaje = $conv->mensajes->last();
                                @endphp
                                <a href="{{ route('mensajes.show', $conv->id) }}"
                                    class="list-group-item list-group-item-action p-3 border-bottom border-0 {{ $isActive ? 'bg-light active-chat' : '' }}">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <h3 class="encabezado mb-1 text-dark">{{ $interlocutor->name ?? 'Usuario' }}
                                            </h3>
                                            <span class="badge {{ $claseBadge }}">{{ $badgeTexto }}</span>
                                        </div>
                                        <small class="texto-secundario text-muted">
                                            {{ $conv->updated_at->format('H:i') }}
                                        </small>
                                    </div>
                                    <p class="texto-secundario fw-bold mb-1 mt-2 text-dark">
                                        {{ $conv->publicacion->titulo ?? 'Artículo' }}</p>
                                    <p class="texto-secundario text-muted text-truncate mb-0">
                                        {{ $ultimoMensaje ? $ultimoMensaje->contenido : 'Inicia la conversación...' }}
                                    </p>
                                </a>
                            @empty
                                <div class="p-4 text-center text-muted">
                                    <p class="mb-0">No tienes conversaciones activas.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>

            {{-- COLUMNA DERECHA: CHAT ACTIVO REAL --}}
            <div class="col-12 col-lg-8">
                @if (isset($conversacionActiva))
                    @php
                        $esCompradorActivo = $conversacionActiva->comprador_id === Auth::id();
                        $interlocutorActivo = $esCompradorActivo
                            ? $conversacionActiva->vendedor
                            : $conversacionActiva->comprador;
                        $badgeActivo = $esCompradorActivo ? 'Vendedor' : 'Comprador';
                        $claseBadgeActivo = $esCompradorActivo ? 'bg-success' : 'bg-primary';
                    @endphp
                    <section class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-flex flex-column h-100">
                        <div class="card-header bg-white border-bottom p-3 p-md-4">
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                                <div>
                                    <h2 class="subtitulo mb-1 text-dark">{{ $interlocutorActivo->name ?? 'Usuario' }}</h2>
                                    <span class="badge {{ $claseBadgeActivo }}">{{ $badgeActivo }}</span>
                                </div>
                                <div class="text-sm-end">
                                    <p class="texto-secundario text-muted mb-0">Publicación relacionada:</p>
                                    <p class="texto-normal fw-bold text-dark mb-0">
                                        {{ $conversacionActiva->publicacion->titulo ?? 'Artículo' }}</p>
                                </div>
                            </div>
                        </div>

                        <div id="listaMensajes" class="card-body p-3 p-md-4 d-flex flex-column gap-3 overflow-auto"
                            style="max-height: 400px; background-color: #FAF6EE;">

                            @foreach ($conversacionActiva->mensajes as $msj)
                                @php
                                    // Sincronizado con emisor_id para evitar errores
                                    $esMio = $msj->emisor_id === Auth::id();
                                @endphp
                                <div class="{{ $esMio ? 'align-self-end text-end' : 'align-self-start' }}"
                                    style="max-width: 80%;">
                                    <p class="texto-secundario fw-bold mb-1 text-muted">
                                        {{ $esMio ? 'Tú' : $msj->emisor->name ?? 'Usuario' }}</p>
                                    <div class="p-3 {{ $esMio ? 'text-white text-start' : 'bg-white text-dark border' }} rounded-3 shadow-sm"
                                        @if ($esMio) style="background-color: var(--color-menu);" @endif>
                                        {{ $msj->contenido }}
                                    </div>
                                    <small
                                        class="texto-secundario text-muted d-block mt-1">{{ $msj->created_at->format('H:i') }}</small>

                                    {{-- Botón de eliminar habilitado únicamente para tus mensajes --}}
                                    @if ($esMio)
                                        <form action="{{ route('mensajes.eliminar', $msj->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link btn-sm text-danger p-0 mt-1 text-decoration-none">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach

                        </div>

                        <div class="card-footer bg-white border-top p-3 p-md-4">
                            <form action="{{ route('mensajes.enviar', $conversacionActiva->id) }}" method="POST">
                                @csrf
                                <label for="mensajeInput" class="form-label texto-normal fw-bold text-dark">Escribe un
                                    mensaje</label>
                                <div class="d-flex flex-column flex-md-row gap-2">
                                    <textarea id="mensajeInput" name="mensaje" class="form-control rounded-3" rows="2" maxlength="500"
                                        placeholder="Escribe tu mensaje aquí..." required></textarea>
                                    <button type="submit"
                                        class="btn btn-primary px-4 rounded-pill texto-normal align-self-md-end">
                                        Enviar
                                    </button>
                                </div>
                                <div class="form-text texto-secundario">Máximo 500 caracteres. (Validado RF10)</div>
                            </form>
                        </div>
                    </section>
                @else
                    <div
                        class="card border-0 shadow-sm rounded-4 bg-white p-5 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                        <h3 class="subtitulo text-muted">Selecciona una conversación</h3>
                        <p class="texto-normal text-muted">Elige un chat de la lista de la izquierda para comenzar a
                            intercambiar mensajes.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Buscador en tiempo real de la izquierda
        document.getElementById('campoBusqueda').addEventListener('input', function() {
            const filtro = this.value.toLowerCase();
            document.querySelectorAll('#listaChats > a').forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(filtro) ? '' : 'none';
            });
        });
    </script>
@endpush
