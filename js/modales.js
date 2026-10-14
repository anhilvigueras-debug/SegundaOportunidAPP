// Justificación de selectores: Se usa querySelector y querySelectorAll para capturar de forma eficiente los botones del catálogo y modificar dinámicamente los elementos dentro del modal unificado.

// 1. Función con nombre para extraer datos con dataset e inyectarlos al modal
function cargarDatosModal(evento) {
    const boton = evento.target.closest('.btn-modal-detalle');
    if (!boton) return;

    // Lectura de los atributos dataset del elemento cliqueado
    const titulo = boton.dataset.titulo;
    const descripcion = boton.dataset.descripcion;
    const imagen = boton.dataset.imagen;
    const precio = boton.dataset.precio;
    const ubicacion = boton.dataset.ubicacion;
    const vendedor = boton.dataset.vendedor;
    const telefono = boton.dataset.telefono;
    const correo = boton.dataset.correo;

    // Inyección dinámica al DOM usando querySelector
    document.querySelector('#modalTitulo').textContent = titulo || 'Detalle del Producto';
    document.querySelector('#modalDescripcion').textContent = descripcion || '';
    document.querySelector('#modalImagen').src = imagen || '';
    document.querySelector('#modalPrecio').textContent = precio || '';
    document.querySelector('#modalUbicacion').textContent = ubicacion || '';
    document.querySelector('#modalVendedor').textContent = vendedor || '';
    
    const elTelefono = document.querySelector('#modalTelefono');
    if (elTelefono) {
        elTelefono.textContent = telefono || '';
        elTelefono.href = `tel:${telefono ? telefono.replace(/\s+/g, '') : ''}`;
    }

    const elCorreo = document.querySelector('#modalCorreo');
    if (elCorreo) {
        elCorreo.textContent = correo || '';
        elCorreo.href = `mailto:${correo || ''}`;
    }

    // Instancia e invocación del modal usando Bootstrap JS
    const elModal = document.querySelector('#modalDinamico');
    if (elModal) {
        const modalBootstrap = bootstrap.Modal.getOrCreateInstance(elModal);
        modalBootstrap.show();
    }
}

// 2. Función con nombre para registrar eventos ( SIN onclick inline)
function inicializarModalesDinamicos() {
    const botonesDetalle = document.querySelectorAll('.btn-modal-detalle');
    botonesDetalle.forEach(function(boton) {
        boton.addEventListener('click', cargarDatosModal);
    });
}

// 3. Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', inicializarModalesDinamicos);