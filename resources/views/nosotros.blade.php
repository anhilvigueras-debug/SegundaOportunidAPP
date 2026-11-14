@extends('layouts.app')

@section('titulo', 'SegundaOportunidAPP - Nosotros')

@section('contenido')
    <div class="container my-4">
        
        <div class="p-4 p-md-5 bg-white border-0 rounded-4 shadow-sm mb-4">
            <h1 class="titulo-principal mb-2">Nosotros</h1>
            <p class="texto-normal text-muted mb-0">Conoce más sobre nuestra visión y el equipo detrás de SegundaOportunidAPP.</p>
        </div>

        <section class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-5" aria-label="Misión">
            <h2 class="subtitulo mb-3">Nuestra misión</h2>
            <p class="texto-normal text-muted mb-0">
                Darle una segunda vida a los objetos que ya no usamos, conectando a personas que quieren vender o donar con quienes los necesitan, y apoyando así a la comunidad de Pachuca y Mineral de la Reforma.
            </p>
        </section>

        <section class="mb-5" aria-label="Equipo">
            <h2 class="subtitulo mb-4">Nuestro equipo</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                
                <!-- MIEMBRO 1 -->
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-white p-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-4 mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: var(--color-accion);">
                                AV
                            </div>
                            <h3 class="encabezado mb-1">Anhil Vigueras Mendoza</h3>
                            <p class="texto-secundario text-muted mb-0">Líder de equipo</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-white p-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-4 mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: var(--color-accion);">
                                DP
                            </div>
                            <h3 class="encabezado mb-1">Diego Pérez Cervantes</h3>
                            <p class="texto-secundario text-muted mb-0">Analista</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-white p-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-4 mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: var(--color-accion);">
                                ZO
                            </div>
                            <h3 class="encabezado mb-1">Zayra Olvera Hernández</h3>
                            <p class="texto-secundario text-muted mb-0">Analista</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-white p-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-4 mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: var(--color-accion);">
                                MZ
                            </div>
                            <h3 class="encabezado mb-1">Marco Antonio Zarco Espinoza</h3>
                            <p class="texto-secundario text-muted mb-0">Frontend</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-white p-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-4 mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: var(--color-accion);">
                                LA
                            </div>
                            <h3 class="encabezado mb-1">Luis Uriel Azpeitia Escamilla</h3>
                            <p class="texto-secundario text-muted mb-0">Frontend</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center bg-white p-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-4 mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: var(--color-accion);">
                                AM
                            </div>
                            <h3 class="encabezado mb-1">Angel Daniel Martínez Rendón</h3>
                            <p class="texto-secundario text-muted mb-0">Backend</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection