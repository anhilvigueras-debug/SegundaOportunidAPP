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

        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <section class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                    <div class="card-body p-0">
                        <div class="p-3 border-bottom bg-light">
                            <h2 class="subtitulo mb-2">Conversaciones</h2>
                            <input type="text" id="campoBusqueda" class="form-control rounded-pill shadow-sm" placeholder="Buscar conversación">
                        </div>
                        <div class="list-group list-group-flush">
                            <button type="button" class="list-group-item list-group-item-action p-3 border-bottom border-0 bg-light">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div>
                                        <h3 class="encabezado mb-1">Juan Pérez</h3>
                                        <span class="badge bg-primary">Comprador</span>
                                    </div>
                                    <small class="texto-secundario text-muted">10:32</small>
                                </div>
                                <p class="texto-secundario fw-bold mb-1 mt-2 text-dark">Bicicleta usada</p>
                                <p class="texto-secundario text-muted text-truncate mb-0">¿Dónde podemos acordar la entrega?</p>
                            </button>

                            <button type="button" class="list-group-item list-group-item-action p-3 border-bottom border-0">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div>
                                        <h3 class="encabezado mb-1">María López</h3>
                                        <span class="badge bg-success">Vendedora</span>
                                    </div>
                                    <small class="texto-secundario text-muted">Ayer</small>
                                </div>
                                <p class="texto-secundario fw-bold mb-1 mt-2 text-dark">Laptop</p>
                                <p class="texto-secundario text-muted text-truncate mb-0">La laptop todavía está disponible.</p>
                            </button>

                            <button type="button" class="list-group-item list-group-item-action p-3 border-0">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div>
                                        <h3 class="encabezado mb-1">Carlos Ruiz</h3>
                                        <span class="badge bg-info text-dark">Donador</span>
                                    </div>
                                    <small class="texto-secundario text-muted">Lun.</small>
                                </div>
                                <p class="texto-secundario fw-bold mb-1 mt-2 text-dark">Ropa en buen estado</p>
                                <p class="texto-secundario text-muted text-truncate mb-0">Puedo entregar la ropa esta semana.</p>
                            </button>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-12 col-lg-8">
                <section class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden d-flex flex-column h-100">
                    <div class="card-header bg-white border-bottom p-3 p-md-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                            <div>
                                <h2 class="subtitulo mb-1">Juan Pérez</h2>
                                <span class="badge bg-primary">Comprador</span>
                            </div>
                            <div class="text-sm-end">
                                <p class="texto-secundario text-muted mb-0">Publicación relacionada:</p>
                                <p class="texto-normal fw-bold text-dark mb-0">Bicicleta usada</p>
                            </div>
                        </div>
                    </div>

                    <div id="listaMensajes" class="card-body p-3 p-md-4 d-flex flex-column gap-3 overflow-auto" style="max-height: 400px; background-color: #FAF6EE;">
                        <div class="align-self-start style-recibido" style="max-width: 80%;">
                            <p class="texto-secundario fw-bold mb-1 text-muted">Juan</p>
                            <div class="p-3 bg-white rounded-3 shadow-sm text-dark border">
                                Hola, ¿todavía está disponible la bicicleta?
                            </div>
                            <small class="texto-secundario text-muted d-block mt-1">10:25</small>
                        </div>

                        <div class="align-self-end text-end mensaje-enviado" style="max-width: 80%;">
                            <p class="texto-secundario fw-bold mb-1 text-muted">Tú</p>
                            <div class="p-3 text-white rounded-3 shadow-sm" style="background-color: var(--color-menu);">
                                Sí, todavía está disponible.
                            </div>
                            <small class="texto-secundario text-muted d-block mt-1">10:28</small>
                            <button type="button" class="btn btn-link btn-sm text-danger p-0 btn-eliminar">Eliminar</button>
                        </div>

                        <div class="align-self-start style-recibido" style="max-width: 80%;">
                            <p class="texto-secundario fw-bold mb-1 text-muted">Juan</p>
                            <div class="p-3 bg-white rounded-3 shadow-sm text-dark border">
                                Perfecto. ¿Dónde podemos acordar la entrega?
                            </div>
                            <small class="texto-secundario text-muted d-block mt-1">10:32</small>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top p-3 p-md-4">
                        <form id="formMensaje" action="" method="POST">
                            @csrf
                            <label for="mensaje" class="form-label texto-normal fw-bold">Escribe un mensaje</label>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <textarea id="mensaje" name="mensaje" class="form-control rounded-3" rows="2" maxlength="500" placeholder="Escribe tu mensaje aquí..." required></textarea>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill texto-normal align-self-md-end">
                                    Enviar
                                </button>
                            </div>
                            <div class="form-text texto-secundario">Máximo 500 caracteres.</div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/delegacion.js') }}"></script>
@endpush