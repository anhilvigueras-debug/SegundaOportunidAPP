@extends('layouts.app')

@section('titulo', 'SegundaOportunidAPP - Inicio')

@section('contenido')
    <section class="container mb-5">
        <div class="p-4 p-md-5 bg-white border-0 rounded-4 shadow-sm text-center text-md-start">
            <h1 class="titulo-principal mb-2">Bienvenido a SegundaOportunidAPP</h1>
            <p class="texto-normal text-muted mb-0">Dándole una segunda vida a los objetos y apoyando a la comunidad.</p>
        </div>
    </section>

    <section class="container mb-5" aria-label="Artículos destacados">
        <h2 class="subtitulo mb-3">Artículos destacados</h2>
        <div class="card border-0 shadow-sm overflow-hidden rounded-4">
            <div id="carouselDestacados" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselDestacados" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselDestacados" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselDestacados" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/bici1.jpg') }}" class="d-block w-100" style="height: 380px; object-fit: cover;" alt="Bicicleta usada">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-3">
                            <h3 class="encabezado text-white mb-1">Bicicleta de montaña</h3>
                            <p class="texto-secundario text-white mb-0">En buen estado, lista para una segunda vida.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/libros1.jpg') }}" class="d-block w-100" style="height: 380px; object-fit: cover;" alt="Colección de libros">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-3">
                            <h3 class="encabezado text-white mb-1">Colección de libros</h3>
                            <p class="texto-secundario text-white mb-0">Donación disponible para quien la necesite.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/silla1.png') }}" class="d-block w-100" style="height: 380px; object-fit: cover;" alt="Silla de oficina">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-3">
                            <h3 class="encabezado text-white mb-1">Silla de oficina</h3>
                            <p class="texto-secundario text-white mb-0">Cómoda y en excelente estado.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDestacados" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDestacados" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </section>

    <section class="container mb-5" aria-label="Catálogo de artículos">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <div>
                <h2 class="subtitulo mb-0">Catálogo</h2>
            </div>

            <div class="d-flex align-items-center gap-2" style="max-width: 250px;">
                <label for="estado" class="form-label mb-0 texto-secundario fw-bold">Estado:</label>
                <select id="estado" class="form-select rounded-3 shadow-sm border-0">
                    <option value="finalizado">Finalizado</option>
                    <option value="entregado">Entregado</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label for="buscarArticulo" class="form-label mb-2 texto-secundario fw-bold">
                Buscar artículo:
            </label>
            <input type="text" 
                   id="buscarArticulo"
                   class="form-control rounded-3 shadow-sm"
                   placeholder="Escribe el nombre del artículo que deseas buscar...">
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <img src="{{ asset('img/bici2.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Bicicleta de montaña" loading="lazy">
                    <div class="card-body d-flex flex-column p-3">
                        <h3 class="encabezado mb-2">Bicicleta de montaña</h3>
                        <p class="texto-secundario text-muted flex-grow-1 mb-2">Rodada 26, en buen estado.</p>
                        <div class="d-flex gap-1 mb-3">
                            <span class="badge bg-secondary">Finalizado</span>
                            <span class="badge bg-success">Venta</span>
                        </div>
                        <button type="button" 
                                class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                data-titulo="Bicicleta de montaña"
                                data-descripcion="Rodada 26, en buen estado."
                                data-imagen="{{ asset('img/bici2.jpg') }}"
                                data-precio="$1,500.00"
                                data-ubicacion="Pachuca de Soto y Mineral de la Reforma, Hidalgo."
                                data-vendedor="Alexander"
                                data-telefono="772 123 4567"
                                data-correo="alexander@gmail.com">
                            Ver detalle
                        </button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <img src="{{ asset('img/libros2.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Colección de libros" loading="lazy">
                    <div class="card-body d-flex flex-column p-3">
                        <h3 class="encabezado mb-2">Colección de libros</h3>
                        <p class="texto-secundario text-muted flex-grow-1 mb-2">10 libros de literatura variada.</p>
                        <div class="d-flex gap-1 mb-3">
                            <span class="badge bg-info text-dark">Donación</span>
                            <span class="badge bg-secondary">Finalizado</span>
                        </div>
                        <button type="button" 
                                class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                data-titulo="Colección de libros"
                                data-descripcion="10 libros de literatura variada."
                                data-imagen="{{ asset('img/libros2.jpg') }}"
                                data-precio="Gratis"
                                data-ubicacion="Colonia Centro, Pachuca de Soto, Hidalgo."
                                data-vendedor="Mariana"
                                data-telefono="771 765 4321"
                                data-correo="mariana.lopez@example.com">
                            Ver detalle
                        </button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <img src="{{ asset('img/silla2.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Silla de oficina" loading="lazy">
                    <div class="card-body d-flex flex-column p-3">
                        <h3 class="encabezado mb-2">Silla de oficina</h3>
                        <p class="texto-secundario text-muted flex-grow-1 mb-2">Ergonómica, con ruedas.</p>
                        <div class="d-flex gap-1 mb-3">
                            <span class="badge bg-success">Venta</span>
                            <span class="badge bg-secondary">Finalizado</span>
                        </div>
                        <button type="button" 
                                class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                data-titulo="Silla de oficina"
                                data-descripcion="Ergonómica, con ruedas."
                                data-imagen="{{ asset('img/silla2.jpg') }}"
                                data-precio="$800.00"
                                data-ubicacion="Colonia Doctores, Pachuca de Soto, Hidalgo."
                                data-vendedor="Carlos"
                                data-telefono="771 987 6543"
                                data-correo="carlos.ramirez@example.com">
                            Ver detalle
                        </button>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <img src="{{ asset('img/lamp1.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Lámpara de escritorio" loading="lazy">
                    <div class="card-body d-flex flex-column p-3">
                        <h3 class="encabezado mb-2">Lámpara de escritorio</h3>
                        <p class="texto-secundario text-muted flex-grow-1 mb-2">Funciona perfecto, luz cálida.</p>
                        <div class="d-flex gap-1 mb-3">
                            <span class="badge bg-info text-dark">Donación</span>
                            <span class="badge bg-secondary">Finalizado</span>
                        </div>
                        <button type="button" 
                                class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                data-titulo="Lámpara de escritorio"
                                data-descripcion="Funciona perfecto, luz cálida."
                                data-imagen="{{ asset('img/lamp1.jpg') }}"
                                data-precio="Gratis"
                                data-ubicacion="Colonia Periodistas, Pachuca de Soto, Hidalgo."
                                data-vendedor="Fernanda"
                                data-telefono="771 456 7890"
                                data-correo="fernanda.torres@example.com">
                            Ver detalle
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection