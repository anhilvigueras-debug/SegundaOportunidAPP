@extends('layouts.app')

@section('titulo', 'SegundaOportunidAPP - Perfil')

@section('contenido')
    <div class="container my-4">
        <h1 class="titulo-principal mb-4">Mi perfil</h1>

        <section class="mb-5" aria-label="Datos del usuario">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-3 text-center mb-3 mb-md-0">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 100px; height: 100px; font-size: 2rem; background-color: var(--color-accion);">
                                LA
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <h2 class="subtitulo mb-3">Luis Uriel Azpeitia Escamilla</h2>
                            <ul class="list-unstyled mb-3 texto-normal">
                                <li><strong>Correo:</strong> luis@example.com</li>
                                <li><strong>Teléfono:</strong> 771 000 0000</li>
                                <li><strong>Ciudad:</strong> Pachuca de Soto, Hidalgo</li>
                                <li><strong>Miembro desde:</strong> Octubre 2026</li>
                            </ul>
                            <button type="button" class="btn btn-primary rounded-pill px-4 texto-normal" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                                Editar perfil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5" aria-label="Historial de publicaciones">
            <h2 class="subtitulo mb-3">Mis publicaciones</h2>

            <form id="formPublicacion" action="" method="POST" class="row g-2 align-items-end mb-4 bg-white p-3 border-0 shadow-sm rounded-4">
                @csrf
                <div class="col-12 col-md-4">
                    <label for="articuloPublicacion" class="form-label texto-normal fw-bold">Artículo</label>
                    <input type="text" class="form-control rounded-3" id="articuloPublicacion" name="articulo" maxlength="60" placeholder="Ej. Mesa de madera" required>
                </div>
                <div class="col-6 col-md-3">
                    <label for="tipoPublicacion" class="form-label texto-normal fw-bold">Tipo</label>
                    <select class="form-select rounded-3" id="tipoPublicacion" name="tipo">
                        <option value="Venta">Venta</option>
                        <option value="Donación">Donación</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label for="precioPublicacion" class="form-label texto-normal fw-bold">Precio</label>
                    <input type="number" class="form-control rounded-3" id="precioPublicacion" name="precio" min="1" step="0.01" placeholder="0.00" required>
                </div>
                <div class="col-12 col-md-3">
                    <button type="submit" class="btn btn-success w-100 rounded-pill texto-normal">Agregar publicación</button>
                </div>
            </form>

            <div class="table-responsive card border-0 shadow-sm rounded-4 p-2 bg-white">
                <table class="table table-striped align-middle text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Artículo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha de publicación</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="listaPublicaciones">
                        <tr>
                            <td>Bicicleta de montaña</td>
                            <td><span class="badge bg-success">Venta</span></td>
                            <td>$1,500.00</td>
                            <td>05/10/2026</td>
                            <td><span class="badge bg-primary">Activa</span></td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm rounded-pill btn-eliminar">Eliminar</button></td>
                        </tr>
                        <tr>
                            <td>Silla de oficina</td>
                            <td><span class="badge bg-success">Venta</span></td>
                            <td>$800.00</td>
                            <td>06/10/2026</td>
                            <td><span class="badge bg-secondary">Finalizada</span></td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm rounded-pill btn-eliminar">Eliminar</button></td>
                        </tr>
                        <tr>
                            <td>Colección de libros</td>
                            <td><span class="badge bg-info text-dark">Donación</span></td>
                            <td>Gratis</td>
                            <td>08/10/2026</td>
                            <td><span class="badge bg-warning text-dark">Entregada</span></td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm rounded-pill btn-eliminar">Eliminar</button></td>
                        </tr>
                        <tr>
                            <td>Lámpara de escritorio</td>
                            <td><span class="badge bg-info text-dark">Donación</span></td>
                            <td>Gratis</td>
                            <td>09/10/2026</td>
                            <td><span class="badge bg-primary">Activa</span></td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm rounded-pill btn-eliminar">Eliminar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Modal Editar Perfil -->
    <div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="tituloModalEditar" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0 pb-0">
                        <h3 class="modal-title encabezado" id="tituloModalEditar">Editar mis datos</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="nombre" class="form-label texto-normal fw-bold">Nombre completo</label>
                            <input type="text" class="form-control rounded-3 p-2" id="nombre" name="nombre" value="Luis Uriel Azpeitia Escamilla" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label texto-normal fw-bold">Correo electrónico</label>
                            <input type="email" class="form-control rounded-3 p-2" id="correo" name="correo" value="luis@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label texto-normal fw-bold">Teléfono</label>
                            <input type="tel" class="form-control rounded-3 p-2" id="telefono" name="telefono" value="7710000000" pattern="[0-9]{10}" required>
                            <div class="form-text texto-secundario">10 dígitos, sin espacios.</div>
                        </div>
                        <div class="mb-0">
                            <label for="ciudad" class="form-label texto-normal fw-bold">Ciudad</label>
                            <input type="text" class="form-control rounded-3 p-2" id="ciudad" name="ciudad" value="Pachuca de Soto, Hidalgo" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-4 texto-secundario" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 texto-normal">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/delegacion.js') }}"></script>
@endpush