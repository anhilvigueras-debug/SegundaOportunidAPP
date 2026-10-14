function crearCelda(contenido) {
    const celda = document.createElement('td');
    celda.textContent = contenido;
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

function obtenerFechaHoy() {
    return new Date().toLocaleDateString('es-MX', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

function crearFilaPublicacion(articulo, tipo, precio) {
    const fila = document.createElement('tr');
    const claseTipo = tipo === 'Venta' ? 'text-bg-success' : 'text-bg-info';
    const textoPrecio = tipo === 'Venta'
        ? Number(precio).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' })
        : 'Gratis';

    fila.appendChild(crearCelda(articulo));
    fila.appendChild(crearCeldaBadge(tipo, claseTipo));
    fila.appendChild(crearCelda(textoPrecio));
    fila.appendChild(crearCelda(obtenerFechaHoy()));
    fila.appendChild(crearCeldaBadge('Activa', 'text-bg-primary'));

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

function iniciarPerfil() {
    const formulario = document.querySelector('#formPublicacion');
    if (!formulario) return;

    formulario.addEventListener('submit', agregarPublicacion);
    document.querySelector('#tipoPublicacion').addEventListener('change', ajustarPrecioPublicacion);
}

document.addEventListener('DOMContentLoaded', iniciarPerfil);