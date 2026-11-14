@extends('layouts.app')

@section('titulo', 'Servicios - SegundaOportunidAPP')

@section('contenido')
    <div class="container my-4">

        <section class="mb-5">
            <div class="p-4 p-md-5 bg-white border-0 rounded-4 shadow-sm text-center mb-4">
                <h1 class="titulo-principal mb-2">Servicios Comunitarios</h1>
                <p class="texto-normal text-muted mb-0">
                    Conoce los servicios de reparación, recolección y apoyo comunitario disponibles.
                </p>
                <div class="mb-4 mt-3">
                    <input type="text" id="campoBusqueda" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Buscar servicio por nombre o descripción...">
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <img src="{{ asset('img/bici1.jpg') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Reparación de bicicletas">
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">Reparación de Bicicletas</h3>
                            <p class="texto-secundario text-muted flex-grow-1 mb-3">Taller comunitario para ajuste de frenos, llantas y cadena.</p>
                            <button type="button" 
                                    class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                    data-titulo="Reparación de Bicicletas"
                                    data-descripcion="Servicio comunitario de diagnóstico y reparación básica de bicicletas."
                                    data-imagen="{{ asset('img/bici1.jpg') }}"
                                    data-precio="Gratuito / Donación voluntaria"
                                    data-ubicacion="Taller Comunitario, Colonia Centro, Pachuca"
                                    data-vendedor="Taller Comunitario"
                                    data-telefono="7711239876"
                                    data-correo="taller.bici@example.com">
                                Ver detalle del servicio
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <img src="{{ asset('img/silla1.png') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Restauración de Muebles">
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">Restauración de Muebles</h3>
                            <p class="texto-secundario text-muted flex-grow-1 mb-3">Servicio de lijado, barnizado y tapicería básica para renovar tu mobiliario.</p>
                            <button type="button" 
                                    class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                    data-titulo="Restauración de Muebles"
                                    data-descripcion="Ayudamos a reacondicionar sillas, mesas y estantes de madera para alargar su vida útil."
                                    data-imagen="{{ asset('img/silla1.png') }}"
                                    data-precio="Costo de materiales"
                                    data-ubicacion="Mineral de la Reforma, Hidalgo"
                                    data-vendedor="Colectivo Madera Viva"
                                    data-telefono="7719876543"
                                    data-correo="maderaviva@example.com">
                                Ver detalle del servicio
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <img src="{{ asset('img/libros1.jpg') }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Recolección a domicilio">
                        <div class="card-body d-flex flex-column p-3">
                            <h3 class="encabezado mb-2">Recolección a Domicilio</h3>
                            <p class="texto-secundario text-muted flex-grow-1 mb-3">Apoyo logístico para recoger donaciones pesadas o de gran volumen.</p>
                            <button type="button" 
                                    class="btn btn-primary w-100 rounded-pill texto-secundario btn-modal-detalle" 
                                    data-titulo="Recolección a Domicilio"
                                    data-descripcion="Programa de apoyo para el traslado seguro de donaciones de gran tamaño."
                                    data-imagen="{{ asset('img/libros1.jpg') }}"
                                    data-precio="Gratuito"
                                    data-ubicacion="Pachuca de Soto y Mineral de la Reforma"
                                    data-vendedor="Equipo SegundaOportunidAPP"
                                    data-telefono="7714567890"
                                    data-correo="soporte@segundaoportunidad.com">
                                Ver detalle del servicio
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection