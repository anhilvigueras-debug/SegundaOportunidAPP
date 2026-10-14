// Justificación de selectores: se usa querySelector para obtener un solo elemento por su id, querySelectorAll para recorrer todas las filas al calcular los totales y closest para encontrar el botón o la fila desde el elemento donde se hizo clic.

const PORCENTAJE_REGALIA = 10;

function crearCelda(contenido) {
    const celda = document.createElement('td');
    celda.textContent = contenido;
    return celda;
}

function crearCeldaConClase(contenido, clases) {
    const celda = crearCelda(contenido);
    celda.className = clases;
    return celda;
}

function crearCeldaBadge(texto, claseBadge) {
    const celda = document.createElement('td');
    const badge = document.createElement('span');
    badge.className = 'badge ' + claseBadge;
    badge.textContent = texto;
    celda.appendChild(badge);
    return celda;
}

function crearCeldaAcciones() {
    const celda = document.createElement('td');
    const boton = document.createElement('button');
    boton.type = 'button';
    boton.className = 'btn btn-outline-danger btn-sm btn-eliminar';
    boton.textContent = 'Eliminar';
    celda.appendChild(boton);
    return celda;
}

function obtenerFechaHoy() {
    return new Date().toLocaleDateString('es-MX', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

function formatearMoneda(valor) {
    return Number(valor).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
}

function crearFilaPublicacion(articulo, tipo, precio) {
    const fila = document.createElement('tr');
    const claseTipo = tipo === 'Venta' ? 'text-bg-success' : 'text-bg-info';
    const textoPrecio = tipo === 'Venta' ? formatearMoneda(precio) : 'Gratis';

    fila.appendChild(crearCelda(articulo));
    fila.appendChild(crearCeldaBadge(tipo, claseTipo));
    fila.appendChild(crearCelda(textoPrecio));
    fila.appendChild(crearCelda(obtenerFechaHoy()));
    fila.appendChild(crearCeldaBadge('Activa', 'text-bg-primary'));
    fila.appendChild(crearCeldaAcciones());

    return fila;
}

function ajustarPrecioPublicacion() {
    const tipo = document.querySelector('#tipoPublicacion');
    const precio = document.querySelector('#precioPublicacion');

    if (tipo.value === 'Donación') {
        precio.value = '';
        precio.disabled = true;
        precio.required = false;
    } else {
        precio.disabled = false;
        precio.required = true;
    }
}

function agregarPublicacion(evento) {
    evento.preventDefault();

    const formulario = document.querySelector('#formPublicacion');
    const articulo = document.querySelector('#articuloPublicacion').value.trim();
    const tipo = document.querySelector('#tipoPublicacion').value;
    const precio = document.querySelector('#precioPublicacion').value;
    const lista = document.querySelector('#listaPublicaciones');

    if (articulo === '') return;

    lista.appendChild(crearFilaPublicacion(articulo, tipo, precio));

    formulario.reset();
    ajustarPrecioPublicacion();
}

function eliminarPublicacion(evento) {
    const boton = evento.target.closest('.btn-eliminar');
    if (!boton) return;

    const fila = boton.closest('tr');
    if (fila) {
        fila.remove();
    }
}

function iniciarPerfil() {
    const formulario = document.querySelector('#formPublicacion');
    if (!formulario) return;

    formulario.addEventListener('submit', agregarPublicacion);
    document.querySelector('#tipoPublicacion').addEventListener('change', ajustarPrecioPublicacion);
    document.querySelector('#listaPublicaciones').addEventListener('click', eliminarPublicacion);
}

function crearFilaVenta(articulo, precio) {
    const fila = document.createElement('tr');
    const monto = Math.round(precio * PORCENTAJE_REGALIA) / 100;

    fila.dataset.precio = precio;
    fila.dataset.regalia = monto;

    fila.appendChild(crearCeldaConClase(articulo, 'fw-semibold'));
    fila.appendChild(crearCelda(obtenerFechaHoy()));
    fila.appendChild(crearCelda(formatearMoneda(precio)));
    fila.appendChild(crearCeldaBadge(PORCENTAJE_REGALIA + ' %', 'bg-light text-dark border'));
    fila.appendChild(crearCeldaConClase(formatearMoneda(monto), 'fw-bold text-success'));
    fila.appendChild(crearCeldaAcciones());

    return fila;
}

function recalcularTotales() {
    const filas = document.querySelectorAll('#listaVentas tr');
    let totalVentas = 0;
    let totalRegalias = 0;

    filas.forEach(function (fila) {
        totalVentas += Number(fila.dataset.precio);
        totalRegalias += Number(fila.dataset.regalia);
    });

    document.querySelector('#totalVentas').textContent = formatearMoneda(totalVentas);
    document.querySelector('#totalRegalias').textContent = formatearMoneda(totalRegalias);
}

function agregarVenta(evento) {
    evento.preventDefault();

    const formulario = document.querySelector('#formVenta');
    const articulo = document.querySelector('#articuloVenta').value.trim();
    const precio = Number(document.querySelector('#precioVenta').value);
    const lista = document.querySelector('#listaVentas');

    if (articulo === '' || precio <= 0) return;

    lista.appendChild(crearFilaVenta(articulo, precio));
    recalcularTotales();

    formulario.reset();
}

function eliminarVenta(evento) {
    const boton = evento.target.closest('.btn-eliminar');
    if (!boton) return;

    const fila = boton.closest('tr');
    if (fila) {
        fila.remove();
        recalcularTotales();
    }
}

function iniciarAdmin() {
    const formulario = document.querySelector('#formVenta');
    if (!formulario) return;

    formulario.addEventListener('submit', agregarVenta);
    document.querySelector('#listaVentas').addEventListener('click', eliminarVenta);
}

document.addEventListener('DOMContentLoaded', iniciarPerfil);
document.addEventListener('DOMContentLoaded', iniciarAdmin);