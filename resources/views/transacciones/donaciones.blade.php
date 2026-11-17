@extends('layouts.app')

@section('titulo', 'SegundaOportunidAPP - Donaciones')

@section('contenido')
    <div class="container my-4">
        <h1 class="mb-2">Donaciones</h1>
        <p class="text-muted mb-4">Dale una segunda vida a lo que ya no usas. Explora las donaciones disponibles o llena el formulario para compartir algo con la comunidad.</p>

        <section class="mb-5">
            <h2 class="subtitulo mb-3">Donaciones Disponibles</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <img src="{{ asset('img/libros1.jpg') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Enciclopedias Infantiles">
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">Enciclopedias Infantiles</h3>
                            <p class="texto-secundario text-muted flex-grow-1 mb-3">Paquete de 5 libros ilustrados en perfecto estado.</p>
                            <button type="button" 
                                    class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                    data-titulo="Enciclopedias Infantiles"
                                    data-descripcion="Colección completa ideal para niños de primaria. Sin páginas rotas ni rayadas."
                                    data-imagen="{{ asset('img/libros1.jpg') }}"
                                    data-precio="Gratis (Donación)"
                                    data-ubicacion="Colonia San Javier, Pachuca"
                                    data-vendedor="Lucía Gómez"
                                    data-telefono="7712345678"
                                    data-correo="lucia.gomez@example.com">
                                Ver detalle de donación
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <img src="{{ asset('img/lamp1.jpg') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Lámpara Velador">
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">Lámpara Velador</h3>
                            <p class="texto-secundario text-muted flex-grow-1 mb-3">Lámpara de noche para recámara, incluye foco LED.</p>
                            <button type="button" 
                                    class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                    data-titulo="Lámpara Velador"
                                    data-descripcion="Funciona al 100%. Cable en buen estado y base sólida de cerámica."
                                    data-imagen="{{ asset('img/lamp1.jpg') }}"
                                    data-precio="Gratis (Donación)"
                                    data-ubicacion="Mineral de la Reforma, Hidalgo"
                                    data-vendedor="Roberto Martínez"
                                    data-telefono="7718765432"
                                    data-correo="roberto.m@example.com">
                                Ver detalle de donación
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <img src="{{ asset('img/bici1.jpg') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Bicicleta Infantil">
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">Bicicleta Infantil Rodada 16</h3>
                            <p class="texto-secundario text-muted flex-grow-1 mb-3">Para niños de 4 a 7 años, detalles estéticos menores.</p>
                            <button type="button" 
                                    class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                    data-titulo="Bicicleta Infantil Rodada 16"
                                    data-descripcion="Bicicleta roja con llantas entrenadoras desmontables. Lista para usarse."
                                    data-imagen="{{ asset('img/bici1.jpg') }}"
                                    data-precio="Gratis (Donación)"
                                    data-ubicacion="Colonia Centro, Pachuca"
                                    data-vendedor="Elena Ramos"
                                    data-telefono="7713456789"
                                    data-correo="elena.ramos@example.com">
                                Ver detalle de donación
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="p-4 border border-0 shadow-sm rounded-4 bg-white" aria-label="Formulario de donación">
            <h2 class="h4 mb-3 subtitulo">Realizar una donación</h2>
            <form id="formDonacion" action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nombreObjeto" class="form-label texto-normal fw-bold">Objeto a donar</label>
                    <input type="text" class="form-control rounded-3 p-2" id="nombreObjeto" name="nombre_objeto" placeholder="Ej. Lámpara de mesa" required>
                </div>
                <div class="mb-3">
                    <label for="categoriaDonacion" class="form-label texto-normal fw-bold">Categoría</label>
                    <select id="categoriaDonacion" name="categoria" class="form-select rounded-3 p-2" required>
                        <option value="" selected disabled>Selecciona una categoría</option>
                        <option value="hogar">Hogar</option>
                        <option value="libros">Libros</option>
                        <option value="deportes">Deportes</option>
                        <option value="ropa">Ropa</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="descripcionDonacion" class="form-label texto-normal fw-bold">Descripción</label>
                    <textarea class="form-control rounded-3 p-2" id="descripcionDonacion" name="descripcion" rows="3" placeholder="Detalles sobre el estado del artículo" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="telefonoDonacion" class="form-label texto-normal fw-bold">Teléfono de contacto</label>
                    <input type="tel" class="form-control rounded-3 p-2" id="telefonoDonacion" name="telefono" pattern="[0-9]{10}" placeholder="10 dígitos" required>
                    <div class="form-text">10 dígitos, sin espacios.</div>
                </div>
                <button type="submit" class="btn btn-success rounded-pill px-4 texto-normal" data-bs-toggle="modal" data-bs-target="#modalConfirmacionDonacion">Enviar donación</button>
            </form>
        </section>
    </div>
@endsection