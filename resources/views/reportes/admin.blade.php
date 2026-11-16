@extends('layouts.app')

@section('titulo', 'SegundaOportunidAPP - Administración')

@section('contenido')
    <div class="container my-4">
        <div class="p-4 bg-white border-0 rounded-4 shadow-sm mb-4">
            <h1 class="titulo-principal mb-1">Panel de administración</h1>
            <p class="texto-normal text-muted mb-0">Sección solo para administradores.</p>
        </div>

        <section aria-label="Resumen de venta y regalías" class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h2 class="subtitulo mb-3">Resumen de venta y regalías</h2>

            <form id="formVenta" action="" method="POST" class="row g-2 align-items-end mb-3">
                @csrf
                <div class="col-12 col-md-5">
                    <label for="articuloVenta" class="form-label">Artículo vendido</label>
                    <input type="text" class="form-control" id="articuloVenta" name="articulo" maxlength="60" placeholder="Ej. Mesa de madera" required>
                </div>
                <div class="col-6 col-md-3">
                    <label for="precioVenta" class="form-label">Precio de venta</label>
                    <input type="number" class="form-control" id="precioVenta" name="precio" min="1" step="0.01" placeholder="0.00" required>
                </div>
                <div class="col-6 col-md-4">
                    <button type="submit" class="btn btn-success w-100">Agregar venta</button>
                </div>
            </form>

            <div class="table-responsive rounded-3 border overflow-hidden">
                <table class="table table-striped table-hover align-middle text-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="encabezado py-3">Artículo</th>
                            <th scope="col" class="encabezado py-3">Fecha</th>
                            <th scope="col" class="encabezado py-3">Precio de venta</th>
                            <th scope="col" class="encabezado py-3">Regalía (%)</th>
                            <th scope="col" class="encabezado py-3">Monto de regalía</th>
                            <th scope="col" class="encabezado py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="listaVentas" class="texto-normal">
                        <tr data-precio="1500" data-regalia="150">
                            <td class="fw-semibold">Bicicleta de montaña</td>
                            <td>05/10/2026</td>
                            <td>$1,500.00</td>
                            <td><span class="badge bg-light text-dark border">10 %</span></td>
                            <td class="fw-bold text-success">$150.00</td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm btn-eliminar">Eliminar</button></td>
                        </tr>
                        <tr data-precio="800" data-regalia="80">
                            <td class="fw-semibold">Silla de oficina</td>
                            <td>06/10/2026</td>
                            <td>$800.00</td>
                            <td><span class="badge bg-light text-dark border">10 %</span></td>
                            <td class="fw-bold text-success">$80.00</td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm btn-eliminar">Eliminar</button></td>
                        </tr>
                        <tr data-precio="250" data-regalia="25">
                            <td class="fw-semibold">Lámpara de escritorio</td>
                            <td>07/10/2026</td>
                            <td>$250.00</td>
                            <td><span class="badge bg-light text-dark border">10 %</span></td>
                            <td class="fw-bold text-success">$25.00</td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm btn-eliminar">Eliminar</button></td>
                        </tr>
                        <tr data-precio="400" data-regalia="40">
                            <td class="fw-semibold">Colección de libros</td>
                            <td>08/10/2026</td>
                            <td>$400.00</td>
                            <td><span class="badge bg-light text-dark border">10 %</span></td>
                            <td class="fw-bold text-success">$40.00</td>
                            <td><button type="button" class="btn btn-outline-danger btn-sm btn-eliminar">Eliminar</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="table-dark">
                            <th scope="row" colspan="2" class="py-3">Totales</th>
                            <td id="totalVentas" class="py-3 fw-bold">$2,950.00</td>
                            <td class="py-3">10 %</td>
                            <td id="totalRegalias" class="py-3 fw-bold text-warning">$295.00</td>
                            <td class="py-3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <p class="texto-secundario text-muted mt-3 mb-0">Valores de ejemplo. El monto de regalía es el precio de venta por el porcentaje.</p>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/delegacion.js') }}"></script>
@endpush